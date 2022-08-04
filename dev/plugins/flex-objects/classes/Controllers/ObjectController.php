<?php

declare(strict_types=1);

namespace Grav\Plugin\FlexObjects\Controllers;

use Grav\Common\Grav;
use Grav\Framework\Flex\FlexForm;
use Grav\Framework\Flex\FlexObject;
use Grav\Framework\Flex\Interfaces\FlexAuthorizeInterface;
use Grav\Framework\Route\Route;
use Grav\Plugin\FlexObjects\Events\FlexTaskEvent;
use Nyholm\Psr7\ServerRequest;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RocketTheme\Toolbox\Event\Event;
use RuntimeException;

/**
 * Object controller is for the frontend.
 *
 * Currently following tasks are supported:
 *
 * - save (create or update)
 * - create
 * - update
 * - delete
 * - reset
 * - preview
 */
class ObjectController extends AbstractController
{
    /**
     * Save object.
     *
     * Forwards call to either create or update task.
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function taskSave(ServerRequestInterface $request): ResponseInterface
    {
        $form = $this->getForm();
        $object = $form->getObject();

        return $object->exists() ? $this->taskUpdate($request) : $this->taskCreate($request);
    }

    /**
     * Create object.
     *
     * Task fails if object exists.
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function taskCreate(ServerRequestInterface $request): ResponseInterface
    {
        $this->checkAuthorization('create');

        $form = $this->getForm();
        $callable = function (array $data, array $files, FlexObject $object) {
            if (method_exists($object, 'storeOriginal')) {
                $object->storeOriginal();
            }
            $object->update($data, $files);
            if (\is_callable([$object, 'check'])) {
                $object->check($this->user);
            }

            $event = new FlexTaskEvent($this, $object, 'create');
            $this->grav->dispatchEvent($event);

            $object->save();
        };

        $form->setSubmitMethod($callable);
        $form->handleRequest($request);
        if (!$form->isValid()) {
            $error = $form->getError();
            if ($error) {
                $this->setMessage($error, 'error');
            }
            $errors = $form->getErrors();
            foreach ($errors as $field) {
                foreach ($field as $error) {
                    $this->setMessage($error, 'error');
                }
            }

            $data = $form->getData();
            if (null !== $data) {
                $object = $form->getObject();
                $flash = $form->getFlash();
                $flash->setObject($object);
                $flash->setData($data->toArray());
                $flash->save();
            }

            return $this->createDisplayResponse();
        }

        // FIXME: make it conditional
        $grav = $this->grav;
        $grav->fireEvent('gitsync');

        $this->object = $form->getObject();
        $event = new Event(
            [
                'task' => 'create',
                'controller' => $this,
                'object' => $this->object,
                'response' => null,
                'message' => null,
            ]
        );

        $this->grav->fireEvent("flex.{$this->type}.task.create.after", $event);

        $this->setMessage($event['message'] ?? $this->translate('PLUGIN_FLEX_OBJECTS.STATE.CREATED_SUCCESSFULLY'), 'info');

        if ($event['response']) {
            return $event['response'];
        }


        $redirect = $request->getAttribute('redirect', (string)$request->getUri());

        return $this->createRedirectResponse($redirect, 303);
    }

    /**
     * Update object.
     *
     * Task fails if object does not exist.
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function taskUpdate(ServerRequestInterface $request): ResponseInterface
    {
        $this->checkAuthorization('update');

        $form = $this->getForm();
        $callable = function (array $data, array $files, FlexObject $object) {
            if (method_exists($object, 'storeOriginal')) {
                $object->storeOriginal();
            }
            $object->update($data, $files);
            if (\is_callable([$object, 'check'])) {
                $object->check($this->user);
            }

            $event = new FlexTaskEvent($this, $object, 'update');
            $this->grav->dispatchEvent($event);

            $object->save();
        };

        $form->setSubmitMethod($callable);
        $form->handleRequest($request);
        if (!$form->isValid()) {
            $error = $form->getError();
            if ($error) {
                $this->setMessage($error, 'error');
            }
            $errors = $form->getErrors();
            foreach ($errors as $field) {
                foreach ($field as $error) {
                    $this->setMessage($error, 'error');
                }
            }

            $data = $form->getData();
            if (null !== $data) {
                $object = $form->getObject();
                $flash = $form->getFlash();
                $flash->setObject($object);
                $flash->setData($data->toArray());
                $flash->save();
            }

            return $this->createDisplayResponse();
        }

        // FIXME: make it conditional
        $grav = $this->grav;
        $grav->fireEvent('gitsync');

        $this->object = $form->getObject();
        $event = new Event(
            [
                'task' => 'update',
                'controller' => $this,
                'object' => $this->object,
                'response' => null,
                'message' => null,
            ]
        );

        $this->grav->fireEvent("flex.{$this->type}.task.update.after", $event);

        $this->setMessage($event['message'] ?? $this->translate('PLUGIN_FLEX_OBJECTS.STATE.UPDATED_SUCCESSFULLY'), 'info');

        if ($event['response']) {
            return $event['response'];
        }

        $redirect = $request->getAttribute('redirect', (string)$request->getUri()->getPath());

        return $this->createRedirectResponse($redirect, 303);
    }

    /**
     * Delete object.
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function taskDelete(ServerRequestInterface $request): ResponseInterface
    {
        $this->checkAuthorization('delete');

        $object = $this->getObject();
        if (!$object) {
            throw new RuntimeException('Not Found', 404);
        }

        $event = new FlexTaskEvent($this, $object, 'delete');
        $this->grav->dispatchEvent($event);

        $object->delete();

        // FIXME: make it conditional
        $grav = $this->grav;
        $grav->fireEvent('gitsync');

        $event = new Event(
            [
                'task' => 'delete',
                'controller' => $this,
                'object' => $object,
                'response' => null,
                'message' => null,
            ]
        );

        $this->grav->fireEvent("flex.{$this->type}.task.delete.after", $event);

        $this->setMessage($this->translate($event['message'] ?? 'PLUGIN_FLEX_OBJECTS.STATE.DELETED_SUCCESSFULLY'), 'info');

        if ($event['response']) {
            return $event['response'];
        }

        $redirect = $request->getAttribute('redirect', (string)$request->getUri()->getPath());

        return $this->createRedirectResponse($redirect, 303);
    }

    /**
     * Reset form to original values.
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function taskReset(ServerRequestInterface $request): ResponseInterface
    {
        $this->checkAuthorization('save');

        $flash = $this->getForm()->getFlash();
        $flash->delete();

        $redirect = $request->getAttribute('redirect', (string)$request->getUri()->getPath());

        return $this->createRedirectResponse($redirect, 303);
    }

    /**
     * Preview object.
     *
     * Takes a form input and converts it to visible presentation of the object.
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function taskPreview(ServerRequestInterface $request): ResponseInterface
    {
        $this->checkAuthorization('save');

        /** @var FlexForm $form */
        $form = $this->getForm('edit');
        $form->setRequest($request);
        if (!$form->validate()) {
            $error = $form->getError();
            if ($error) {
                $this->setMessage($error, 'error');
            }
            $errors = $form->getErrors();
            foreach ($errors as $field) {
                foreach ($field as $error) {
                    $this->setMessage($error, 'error');
                }
            }

            return $this->createRedirectResponse((string)$request->getUri(), 303);
        }

        $this->object = $form->updateObject();

        return $this->actionDisplayPreview();
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function taskMediaList(ServerRequestInterface $request): ResponseInterface
    {
        $directory = $this->getDirectory();
        if (!$directory) {
            throw new RuntimeException('Not Found', 404);
        }

        return $this->forwardMediaTask('action', 'media.list');
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function taskMediaUpload(ServerRequestInterface $request): ResponseInterface
    {
        $directory = $this->getDirectory();
        if (!$directory) {
            throw new RuntimeException('Not Found', 404);
        }

        return $this->forwardMediaTask('task', 'media.upload');
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function taskMediaDelete(ServerRequestInterface $request): ResponseInterface
    {
        $directory = $this->getDirectory();
        if (!$directory) {
            throw new RuntimeException('Not Found', 404);
        }

        return $this->forwardMediaTask('task', 'media.delete');
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function taskGetFilesInFolder(ServerRequestInterface $request): ResponseInterface
    {
        $directory = $this->getDirectory();
        if (!$directory) {
            throw new RuntimeException('Not Found', 404);
        }

        return $this->forwardMediaTask('action', 'media.picker');
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @deprecated Do not use
     */
    public function taskFilesUpload(ServerRequestInterface $request): ResponseInterface
    {
        /** @var Route $route */
        $route = $this->grav['route'];
        if ($route->getParam('task') === 'media.upload') {
            return $this->taskMediaUpload($request);
        }

        throw new RuntimeException('Task filesUpload should not be called, please update form plugin!', 400);
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @deprecated Do not use
     */
    public function taskRemoveMedia(ServerRequestInterface $request): ResponseInterface
    {
        /** @var Route $route */
        $route = $this->grav['route'];
        if ($route->getParam('task') === 'media.delete') {
            return $this->taskMediaDelete($request);
        }

        throw new RuntimeException('Task removeMedia should not be called, please update form plugin!', 400);
    }

    /**
     * Display object preview.
     *
     * @return ResponseInterface
     */
    public function actionDisplayPreview(): ResponseInterface
    {
        $this->checkAuthorization('save');
        $this->checkAuthorization('read');

        $object = $this->getObject();
        if (!$object) {
            throw new RuntimeException('No object found!', 404);
        }

        $grav = Grav::instance();

        $grav['twig']->init();
        $grav['theme'];
        $content = [
            'code' => 200,
            'id' => $object->getKey(),
            'exists' => $object->exists(),
            'html' => (string)$object->render('preview', ['nocache' => []])
        ];

        $accept = $this->getAccept(['application/json', 'text/html']);
        if ($accept === 'text/html') {
            return $this->createHtmlResponse($content['html']);
        }
        if ($accept === 'application/json') {
            return $this->createJsonResponse($content);
        }

        throw new RuntimeException('Not found', 404);
    }

    /**
     * @param string $action
     * @param string|null $scope
     * @return void
     * @throws RuntimeException
     */
    public function checkAuthorization(string $action, string $scope = null): void
    {
        $object = $this->getObject();

        if (!$object) {
            throw new RuntimeException('Not Found', 404);
        }

        if ($object instanceof FlexAuthorizeInterface) {
            if (!$object->isAuthorized($action, $scope, $this->user)) {
                throw new RuntimeException('Forbidden', 403);
            }
        }
    }


    /**
     * @param string[] $actions
     * @return void
     * @throws RuntimeException
     */
    public function checkAuthorizations(array $actions): void
    {
        $object = $this->getObject();

        if (!$object) {
            throw new RuntimeException('Not Found', 404);
        }

        if ($object instanceof FlexAuthorizeInterface) {
            $test = false;
            foreach ($actions as $action) {
                $test |= $object->isAuthorized($action, null, $this->user);
            }

            if (!$test) {
                throw new RuntimeException('Forbidden', 403);
            }
        }
    }

    /**
     * @param string $type
     * @param string $name
     * @return ResponseInterface
     */
    protected function forwardMediaTask(string $type, string $name): ResponseInterface
    {
        /** @var Route $route */
        $route = $this->grav['route']->withGravParam('task', null)->withGravParam($type, $name);
        $object = $this->getObject();

        /** @var ServerRequest $request */
        $request = $this->grav['request'];
        $request = $request
            ->withAttribute($type, $name)
            ->withAttribute('type', $this->type)
            ->withAttribute('key', $this->key)
            ->withAttribute('storage_key', $object && $object->exists() ? $object->getStorageKey() : null)
            ->withAttribute('route', $route)
            ->withAttribute('forwarded', true)
            ->withAttribute('object', $object);

        $controller = new MediaController();
        if ($this->user) {
            $controller->setUser($this->user);
        }

        return $controller->handle($request);
    }
}
