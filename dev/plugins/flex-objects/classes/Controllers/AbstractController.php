<?php

declare(strict_types=1);

namespace Grav\Plugin\FlexObjects\Controllers;

use Grav\Common\Config\Config;
use Grav\Common\Grav;
use Grav\Common\Inflector;
use Grav\Common\Language\Language;
use Grav\Common\Session;
use Grav\Common\Uri;
use Grav\Common\User\Interfaces\UserInterface;
use Grav\Common\Utils;
use Grav\Framework\Controller\Traits\ControllerResponseTrait;
use Grav\Framework\Flex\FlexDirectory;
use Grav\Framework\Flex\FlexForm;
use Grav\Framework\Flex\FlexFormFlash;
use Grav\Framework\Flex\Interfaces\FlexFormInterface;
use Grav\Framework\Flex\Interfaces\FlexObjectInterface;
use Grav\Framework\Psr7\Response;
use Grav\Framework\RequestHandler\Exception\NotFoundException;
use Grav\Framework\RequestHandler\Exception\PageExpiredException;
use Grav\Framework\Route\Route;
use Grav\Plugin\FlexObjects\Flex;
use Grav\Plugin\Form\Forms;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use RocketTheme\Toolbox\Event\Event;
use RocketTheme\Toolbox\Session\Message;
use function in_array;
use function is_callable;

/**
 * Class AbstractController
 * @package Grav\Plugin\FlexObjects\Controllers
 */
abstract class AbstractController implements RequestHandlerInterface
{
    use ControllerResponseTrait;

    /** @var string */
    protected $nonce_action = 'flex-object';
    /** @var string */
    protected $nonce_name = 'nonce';
    /** @var ServerRequestInterface */
    protected $request;
    /** @var Grav */
    protected $grav;
    /** @var UserInterface|null */
    protected $user;
    /** @var string */
    protected $type;
    /** @var string */
    protected $key;
    /** @var FlexDirectory */
    protected $directory;
    /** @var FlexObjectInterface */
    protected $object;

    /**
     * Handle request.
     *
     * Fires event: flex.[directory].[task|action].[command]
     *
     * @param ServerRequestInterface $request
     * @return Response
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $attributes = $request->getAttributes();
        $this->request = $request;
        $this->grav = $attributes['grav'] ?? Grav::instance();
        $this->type =  $attributes['type'] ?? null;
        $this->key =  $attributes['key'] ?? null;
        if ($this->type) {
            $this->directory = $this->getFlex()->getDirectory($this->type);
            $this->object = $attributes['object'] ?? null;
            if (!$this->object && $this->key && $this->directory) {
                $this->object = $this->directory->getObject($this->key) ?? $this->directory->createObject([], $this->key ?? '');
                if (is_callable([$this->object, 'refresh'])) {
                    $this->object->refresh();
                }
            }
        }

        /** @var Route $route */
        $route = $attributes['route'];
        $post = $this->getPost();

        if ($this->isFormSubmit()) {
            $form = $this->getForm();
            $this->nonce_name = $attributes['nonce_name'] ?? $form->getNonceName();
            $this->nonce_action = $attributes['nonce_action'] ?? $form->getNonceAction();
        }

        try {
            $task = $request->getAttribute('task') ?? $post['task'] ?? $route->getParam('task');
            if ($task) {
                if (empty($attributes['forwarded'])) {
                    $this->checkNonce($task);
                }
                $type = 'task';
                $command = $task;
            } else {
                $type = 'action';
                $command = $request->getAttribute('action') ?? $post['action'] ?? $route->getParam('action') ?? 'display';
            }
            $command = strtolower($command);

            $event = new Event(
                [
                    'controller' => $this,
                    'response' => null
                ]
            );

            $this->grav->fireEvent("flex.{$this->type}.{$type}.{$command}", $event);

            $response = $event['response'];
            if (!$response) {
                /** @var Inflector $inflector */
                $inflector = $this->grav['inflector'];
                $method = $type . $inflector::camelize($command);
                if ($method && method_exists($this, $method)) {
                    $response = $this->{$method}($request);
                } else {
                    throw new NotFoundException($request);
                }
            }
        } catch (\Exception $e) {
            $response = $this->createErrorResponse($e);
        }

        if ($response instanceof Response) {
            return $response;
        }

        return $this->createJsonResponse($response);
    }

    /**
     * @return ServerRequestInterface
     */
    public function getRequest(): ServerRequestInterface
    {
        return $this->request;
    }

    /**
     * @param string|null $name
     * @param mixed $default
     * @return mixed
     */
    public function getPost(string $name = null, $default = null)
    {
        $body = $this->request->getParsedBody();

        if ($name) {
            return $body[$name] ?? $default;
        }

        return $body;
    }

    /**
     * @return bool
     */
    public function isFormSubmit(): bool
    {
        return (bool)$this->getPost('__form-name__');
    }

    /**
     * @param string|null $type
     * @return FlexForm
     */
    public function getForm(string $type = null): FlexFormInterface
    {
        $object = $this->getObject();
        if (!$object) {
            throw new \RuntimeException('Not Found', 404);
        }

        $formName = $this->getPost('__form-name__');
        if ($formName) {
            /** @var Forms $forms */
            $forms = $this->getGrav()['forms'];
            $form = $forms->getActiveForm();
            if ($form instanceof FlexForm && $form->getName() === $formName && $form->getObject()->getFlexKey() === $object->getFlexKey()) {
                return $form;
            }
        }

        return $object->getForm($type ?? 'edit');
    }

    /**
     * @param FlexObjectInterface $object
     * @param string $type
     * @return FlexFormFlash
     */
    protected function getFormFlash(FlexObjectInterface $object, string $type = '')
    {
        /** @var Uri $uri */
        $uri = $this->grav['uri'];
        $url = $uri->url;

        $formName = $this->getPost('__form-name__');
        if (!$formName) {
            $form = $object->getForm($type);
            $formName = $form->getName();
            $uniqueId = $form->getUniqueId();
        } else {
            $uniqueId = $this->getPost('__unique_form_id__') ?: $formName ?: sha1($url);
        }

        /** @var Session $session */
        $session = $this->grav['session'];

        $config = [
            'session_id' => $session->getId(),
            'unique_id' => $uniqueId,
            'form_name' => $formName,
        ];
        $flash = new FlexFormFlash($config);
        if (!$flash->exists()) {
            $flash->setUrl($url)->setUser($this->grav['user']);
        }

        return $flash;
    }

    /**
     * @return Grav
     */
    public function getGrav(): Grav
    {
        return $this->grav;
    }

    /**
     * @return Session
     */
    public function getSession(): Session
    {
        return $this->grav['session'];
    }

    /**
     * @return Flex
     */
    public function getFlex(): Flex
    {
        return $this->grav['flex_objects'];
    }

    /**
     * @return string
     */
    public function getDirectoryType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getObjectKey(): string
    {
        return $this->key;
    }

    /**
     * @return FlexDirectory|null
     */
    public function getDirectory(): ?FlexDirectory
    {
        return $this->directory;
    }

    /**
     * @return FlexObjectInterface|null
     */
    public function getObject(): ?FlexObjectInterface
    {
        return $this->object;
    }

    /**
     * @param string $string
     * @return string
     */
    public function translate(string $string): string
    {
        /** @var Language $language */
        $language = $this->grav['language'];

        return $language->translate($string);
    }

    /**
     * @param string $message
     * @param string $type
     * @return $this
     */
    public function setMessage(string $message, string $type = 'info'): self
    {
        /** @var Message $messages */
        $messages = $this->grav['messages'];
        $messages->add($message, $type);

        return $this;
    }

    /**
     * @param UserInterface $user
     * @return void
     */
    public function setUser(UserInterface $user): void
    {
        $this->user = $user;
    }

    /**
     * @return Config
     */
    protected function getConfig(): Config
    {
        return $this->grav['config'];
    }

    /**
     * @param string $task
     * @return void
     * @throws PageExpiredException
     */
    protected function checkNonce(string $task): void
    {
        $nonce = null;

        if (in_array(strtoupper($this->request->getMethod()), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            $nonce = $this->getPost($this->nonce_name);
        }

        if (!$nonce) {
            $nonce = $this->grav['uri']->param($this->nonce_name);
        }

        if (!$nonce) {
            $nonce = $this->grav['uri']->query($this->nonce_name);
        }

        if (!$nonce || !Utils::verifyNonce($nonce, $this->nonce_action)) {
            throw new PageExpiredException($this->request);
        }
    }
}
