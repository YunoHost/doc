<?php

namespace Grav\Plugin\Form;

use ArrayAccess;
use Grav\Common\Config\Config;
use Grav\Common\Data\Data;
use Grav\Common\Data\Blueprint;
use Grav\Common\Data\ValidationException;
use Grav\Common\Filesystem\Folder;
use Grav\Common\Form\FormFlash;
use Grav\Common\Grav;
use Grav\Common\Inflector;
use Grav\Common\Language\Language;
use Grav\Common\Page\Interfaces\PageInterface;
use Grav\Common\Page\Pages;
use Grav\Common\Security;
use Grav\Common\Uri;
use Grav\Common\Utils;
use Grav\Framework\Filesystem\Filesystem;
use Grav\Framework\Form\FormFlashFile;
use Grav\Framework\Form\Interfaces\FormInterface;
use Grav\Framework\Form\Traits\FormTrait;
use Grav\Framework\Route\Route;
use RocketTheme\Toolbox\ArrayTraits\NestedArrayAccessWithGetters;
use RocketTheme\Toolbox\Event\Event;
use RocketTheme\Toolbox\ResourceLocator\UniformResourceLocator;
use RuntimeException;
use stdClass;
use function is_array;
use function is_int;
use function is_string;
use function json_encode;

/**
 * Class Form
 * @package Grav\Plugin\Form
 *
 * @property string $id
 * @property string $uniqueid
 * @property string $name
 * @property string $noncename
 * @property string $nonceaction
 * @property string $action
 * @property Data $data
 * @property array $files
 * @property Data $value
 * @property array $errors
 * @property array $fields
 * @property Blueprint $blueprint
 * @property PageInterface $page
 */
class Form implements FormInterface, ArrayAccess
{
    use NestedArrayAccessWithGetters {
        NestedArrayAccessWithGetters::get as private traitGet;
        NestedArrayAccessWithGetters::set as private traitSet;
    }
    use FormTrait {
        FormTrait::reset as private traitReset;
        FormTrait::doSerialize as private doTraitSerialize;
        FormTrait::doUnserialize as private doTraitUnserialize;
    }

    /** @var int */
    public const BYTES_TO_MB = 1048576;

    /** @var string */
    public $message;
    /** @var int */
    public $response_code;
    /** @var string */
    public $status = 'success';

    /** @var array */
    protected $header_data = [];
    /** @var array */
    protected $rules = [];

    /**
     * Form header items
     *
     * @var array $items
     */
    protected $items = [];

    /**
     * All the form data values, including non-data
     *
     * @var Data $values
     */
    protected $values;

    /**
     * The form page route
     *
     * @var string $page
     */
    protected $page;

    /**
     * Create form for the given page.
     *
     * @param PageInterface $page
     * @param string|int|null $name
     * @param array|null $form
     */
    public function __construct(PageInterface $page, $name = null, $form = null)
    {
        $this->nestedSeparator = '/';

        $slug = $page->slug();
        $header = $page->header();
        $this->rules = $header->rules ?? [];
        $this->header_data = $header->data ?? [];

        if ($form) {
            // If form is given, use it.
            $this->items = $form;
        } else {
            // Otherwise get all forms in the page.
            $forms = $page->getForms();
            if ($name) {
                // If form with given name was found, use that.
                $this->items = $forms[$name] ?? [];
            } else {
                // Otherwise pick up the first form.
                $this->items = reset($forms) ?: [];
                $name = key($forms);
            }
        }

        // If we're on a modular page, find the real page.
        while ($page && $page->modularTwig()) {
            $header = $page->header();
            $header->never_cache_twig = true;
            $page = $page->parent();
        }

        $this->page = $page ? $page->route() : '/';

        // Add form specific rules.
        if (!empty($this->items['rules']) && is_array($this->items['rules'])) {
            $this->rules += $this->items['rules'];
        }

        // Set form name if not set.
        if ($name && !is_int($name)) {
            $this->items['name'] = $name;
        } elseif (empty($this->items['name'])) {
            $this->items['name'] = $slug;
        }

        // Set form id if not set.
        if (empty($this->items['id'])) {
            $this->items['id'] = Inflector::hyphenize($this->items['name']);
        }

        if (empty($this->items['nonce']['name'])) {
            $this->items['nonce']['name'] = 'form-nonce';
        }

        if (empty($this->items['nonce']['action'])) {
            $this->items['nonce']['action'] = 'form';
        }

        if (Utils::isPositive($this->items['disabled'] ?? false)) {
            $this->disable();
        }

        // Initialize form properties.
        $this->name = $this->items['name'];
        $this->setId($this->items['id']);

        $uniqueid = $this->items['uniqueid'] ?? null;
        if (null === $uniqueid && !empty($this->items['remember_state'])) {
            $this->set('remember_redirect', true);
        }
        $this->setUniqueId($uniqueid ?? strtolower(Utils::generateRandomString($this->items['uniqueid_len'] ?? 20)));

        $this->initialize();
    }

    /**
     * @return $this
     */
    public function initialize()
    {
        // Reset and initialize the form
        $this->errors = [];
        $this->submitted = false;
        $this->unsetFlash();

        // Remember form state.
        $flash = $this->getFlash();
        if ($flash->exists()) {
            $data = $flash->getData() ?? $this->header_data;
        } else {
            $data = $this->header_data;
        }

        // Remember data and files.
        $this->setAllData($data);
        $this->setAllFiles($flash);
        $this->values = new Data();

        // Fire event
        $grav = Grav::instance();
        $grav->fireEvent('onFormInitialized', new Event(['form' => $this]));

        return $this;
    }

    /**
     * @param FormFlash $flash
     * @return void
     */
    protected function setAllFiles(FormFlash $flash)
    {
        if (!$flash->exists()) {
            return;
        }

        /** @var Uri $url */
        $url = Grav::instance()['uri'];
        $fields = $flash->getFilesByFields(true);
        foreach ($fields as $field => $files) {
            if (strpos($field, '/') !== false) {
                continue;
            }

            $list = [];
            /**
             * @var string $filename
             * @var FormFlashFile $file
             */
            foreach ($files as $filename => $file) {
                $original = $fields["{$field}/original"][$filename] ?? $file;
                $basename = basename($filename);
                if ($file) {
                    $imagePath = $original->getTmpFile();
                    $thumbPath = $file->getTmpFile();
                    $list[$basename] = [
                        'name' => $file->getClientFilename(),
                        'type' => $file->getClientMediaType(),
                        'size' => $file->getSize(),
                        'image_url' => $url->rootUrl() . '/' . Folder::getRelativePath($imagePath) . '?' . filemtime($imagePath),
                        'thumb_url' => $url->rootUrl() . '/' . Folder::getRelativePath($thumbPath) . '?' . filemtime($thumbPath),
                        'cropData' => $original->getMetaData()['crop'] ?? []
                    ];
                }
            }

            $this->setData($field, $list);
        }
    }

    /**
     * Reset form.
     *
     * @return void
     */
    public function reset(): void
    {
        $this->traitReset();

        // Reset and initialize the form
        $this->blueprint = null;
        $this->setAllData($this->header_data);
        $this->values = new Data();

        // Reset unique id (allow multiple form submits)
        $uniqueid = $this->items['uniqueid'] ?? null;
        $this->set('remember_redirect', null === $uniqueid && !empty($this->items['remember_state']));
        $this->setUniqueId($uniqueid ?? strtolower(Utils::generateRandomString($this->items['uniqueid_len'] ?? 20)));

        // Fire event
        $grav = Grav::instance();
        $grav->fireEvent('onFormInitialized', new Event(['form' => $this]));
    }

    /**
     * @param string $name
     * @param mixed|null $default
     * @param string|null $separator
     * @return mixed
     */
    public function get($name, $default = null, $separator = null)
    {
        switch (strtolower($name)) {
            case 'id':
            case 'uniqueid':
            case 'name':
            case 'noncename':
            case 'nonceaction':
            case 'action':
            case 'data':
            case 'files':
            case 'errors';
            case 'fields':
            case 'blueprint':
            case 'page':
                $method = 'get' . $name;
                return $this->{$method}();
        }

        return $this->traitGet($name, $default, $separator);
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->items['action'] ?? $this->page;
    }

    /**
     * @param string $message
     * @param string $type
     * @todo Type not used
     */
    public function setMessage($message, $type = 'error')
    {
        $this->setError($message);
    }

    /**
     * @param string $name
     * @param mixed $value
     * @param string|null $separator
     * @return Form
     */
    public function set($name, $value, $separator = null)
    {
        switch (strtolower($name)) {
            case 'id':
            case 'uniqueid':
                $method = 'set' . $name;
                return $this->{$method}();
        }

        return $this->traitSet($name, $value, $separator);
    }

    /**
     * Get the nonce value for a form
     *
     * @return string
     */
    public function getNonce(): string
    {
        return Utils::getNonce($this->getNonceAction());
    }

    /**
     * @inheritdoc
     */
    public function getNonceName(): string
    {
        return $this->items['nonce']['name'];
    }

    /**
     * @inheritdoc
     */
    public function getNonceAction(): string
    {
        return $this->items['nonce']['action'];
    }

    /**
     * @inheritdoc
     */
    public function getValue(string $name)
    {
        return $this->values->get($name);
    }

    /**
     * @return Data
     */
    public function getValues(): Data
    {
        return $this->values;
    }

    /**
     * @inheritdoc
     */
    public function getFields(): array
    {
        return $this->getBlueprint()->fields();
    }

    /**
     * Return page object for the form.
     *
     * Can be called only after onPageInitialize event has fired.
     *
     * @return PageInterface
     * @throws \LogicException
     */
    public function getPage(): PageInterface
    {
        /** @var Pages $pages */
        $pages = Grav::instance()['pages'];
        $page = $pages->find($this->page);
        if (null === $page) {
            throw new \LogicException('Form::getPage() method was called too early!');
        }

        return $page;
    }

    /**
     * @inheritdoc
     */
    public function getBlueprint(): Blueprint
    {
        if (null === $this->blueprint) {
            // Fix naming for fields (supports nested fields now!)
            if (isset($this->items['fields'])) {
                $this->items['fields'] = $this->processFields($this->items['fields']);
            }

            $blueprint = new Blueprint($this->name, ['form' => $this->items, 'rules' => $this->rules]);
            $blueprint->load()->init();

            $this->blueprint = $blueprint;
        }

        return $this->blueprint;
    }

    /**
     * Allow overriding of fields.
     *
     * @param array $fields
     * @return void
     */
    public function setFields(array $fields = [])
    {
        $this->items['fields'] = $fields;
        unset($this->items['field']);

        // Reset blueprint.
        $this->blueprint = null;

        // Update data to contain the new blueprints.
        $this->setAllData($this->data->toArray());
    }

    /**
     * Get value of given variable (or all values).
     * First look in the $data array, fallback to the $values array
     *
     * @param string|null $name
     * @param bool $fallback
     * @return mixed
     */
    public function value($name = null, $fallback = false)
    {
        if (!$name) {
            return $this->data;
        }

        if (isset($this->data[$name])) {
            return $this->data[$name];
        }

        if ($fallback) {
            return $this->values[$name];
        }

        return null;
    }

    /**
     * Get value of given variable (or all values).
     *
     * @param string|null $name
     * @return mixed
     */
    public function data($name = null)
    {
        return $this->value($name);
    }

    /**
     * Set value of given variable in the values array
     *
     * @param string|null $name
     * @param mixed $value
     * @return void
     */
    public function setValue($name = null, $value = '')
    {
        if (!$name) {
            return;
        }

        $this->values->set($name, $value);
    }

    /**
     * Set value of given variable in the data array
     *
     * @param string|null $name
     * @param string $value
     * @return bool
     */
    public function setData($name = null, $value = '')
    {
        if (!$name) {
            return false;
        }

        $this->data->set($name, $value);

        return true;
    }

    /**
     * @param array $array
     * @return void
     */
    public function setAllData($array): void
    {
        $callable = function () {
            return $this->getBlueprint();
        };

        $this->data = new Data($array, $callable);
    }

    /**
     * Handles ajax upload for files.
     * Stores in a flash object the temporary file and deals with potential file errors.
     *
     * @return mixed True if the action was performed.
     */
    public function uploadFiles()
    {
        $grav = Grav::instance();

        /** @var Uri $uri */
        $uri = $grav['uri'];

        $url = $uri->url;
        $post = $uri->post();

        $name = $post['name'] ?? null;
        $task = $post['task'] ?? null;

        /** @var Language $language */
        $language = $grav['language'];

        /** @var Config $config */
        $config = $grav['config'];

        $settings = $this->getBlueprint()->schema()->getProperty($name);
        $settings = (object) array_merge(
            ['destination' => $config->get('plugins.form.files.destination', 'self@'),
                'avoid_overwriting' => $config->get('plugins.form.files.avoid_overwriting', false),
                'random_name' => $config->get('plugins.form.files.random_name', false),
                'accept' => $config->get('plugins.form.files.accept', ['image/*']),
                'limit' => $config->get('plugins.form.files.limit', 10),
                'filesize' => static::getMaxFilesize(),
            ],
            (array) $settings,
            ['name' => $name]
        );
        // Allow plugins to adapt settings for a given post name
        // Useful if schema retrieval is not an option, e.g. dynamically created forms
        $grav->fireEvent('onFormUploadSettings', new Event(['settings' => &$settings, 'post' => $post]));

        $upload = json_decode(json_encode($this->normalizeFiles($_FILES['data'], $settings->name)), true);
        $filename = $post['filename'] ?? $upload['file']['name'];
        $field = $upload['field'];

        // Handle errors and breaks without proceeding further
        if ($upload['file']['error'] !== UPLOAD_ERR_OK) {
            // json_response
            return [
                'status' => 'error',
                'message' => sprintf(
                    $language->translate('PLUGIN_FORM.FILEUPLOAD_UNABLE_TO_UPLOAD', null, true),
                    $filename,
                    $this->getFileUploadError($upload['file']['error'], $language)
                )
            ];
        }

        // Handle bad filenames.
        if (!Utils::checkFilename($filename)) {
            return [
                'status'  => 'error',
                'message' => sprintf($language->translate('PLUGIN_FORM.FILEUPLOAD_UNABLE_TO_UPLOAD', null),
                    $filename, 'Bad filename')
            ];
        }

        if (!isset($settings->destination)) {
            return [
                'status'  => 'error',
                'message' => $language->translate('PLUGIN_FORM.DESTINATION_NOT_SPECIFIED', null)
            ];
        }

        // Remove the error object to avoid storing it
        unset($upload['file']['error']);


        // Handle Accepted file types
        // Accept can only be mime types (image/png | image/*) or file extensions (.pdf|.jpg)
        $accepted = false;
        $errors = [];

        // Do not trust mimetype sent by the browser
        $mime = Utils::getMimeByFilename($filename);

        foreach ((array)$settings->accept as $type) {
            // Force acceptance of any file when star notation
            if ($type === '*') {
                $accepted = true;
                break;
            }

            $isMime = strstr($type, '/');
            $find   = str_replace(['.', '*', '+'], ['\.', '.*', '\+'], $type);

            if ($isMime) {
                $match = preg_match('#' . $find . '$#', $mime);
                if (!$match) {
                    $errors[] = sprintf($language->translate('PLUGIN_FORM.INVALID_MIME_TYPE', null, true), $mime, $filename);
                } else {
                    $accepted = true;
                    break;
                }
            } else {
                $match = preg_match('#' . $find . '$#', $filename);
                if (!$match) {
                    $errors[] = sprintf($language->translate('PLUGIN_FORM.INVALID_FILE_EXTENSION', null, true), $filename);
                } else {
                    $accepted = true;
                    break;
                }
            }
        }

        if (!$accepted) {
            // json_response
            return [
                'status' => 'error',
                'message' => implode('<br/>', $errors)
            ];
        }


        // Handle file size limits
        $settings->filesize *= self::BYTES_TO_MB; // 1024 * 1024 [MB in Bytes]
        if ($settings->filesize > 0 && $upload['file']['size'] > $settings->filesize) {
            // json_response
            return [
                'status'  => 'error',
                'message' => $language->translate('PLUGIN_FORM.EXCEEDED_GRAV_FILESIZE_LIMIT')
            ];
        }

        // Generate random name if required
        if ($settings->random_name) {
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $filename = Utils::generateRandomString(15) . '.' . $extension;
        }

        // Look up for destination
        /** @var UniformResourceLocator $locator */
        $locator = $grav['locator'];
        $destination = $settings->destination;
        if (!$locator->isStream($destination)) {
            $destination = $this->getPagePathFromToken(Folder::getRelativePath(rtrim($settings->destination, '/')));
        }

        // Handle conflicting name if needed
        if ($settings->avoid_overwriting) {
            if (file_exists($destination . '/' . $filename)) {
                $filename = date('YmdHis') . '-' . $filename;
            }
        }

        // Prepare object for later save
        $path = $destination . '/' . $filename;
        $upload['file']['name'] = $filename;
        $upload['file']['path'] = $path;

        // Special Sanitization for SVG
        if (method_exists('Grav\Common\Security', 'sanitizeSVG') && Utils::contains($mime, 'svg', false)) {
            Security::sanitizeSVG($upload['file']['tmp_name']);
        }

        // We need to store the file into flash object or it will not be available upon save later on.
        $flash = $this->getFlash();
        $flash->setUrl($url)->setUser($grav['user'] ?? null);

        if ($task === 'cropupload') {
            $crop = $post['crop'];
            if (is_string($crop)) {
                $crop = json_decode($crop, true);
            }
            $success = $flash->cropFile($field, $filename, $upload, $crop);
        } else {
            $success = $flash->uploadFile($field, $filename, $upload);
        }

        if (!$success) {
            // json_response
            return [
                'status' => 'error',
                'message' => sprintf($language->translate('PLUGIN_FORM.FILEUPLOAD_UNABLE_TO_MOVE', null, true), '', $flash->getTmpDir())
            ];
        }

        $flash->save();

        // json_response
        $json_response = [
            'status' => 'success',
            'session' => json_encode([
                'sessionField' => base64_encode($url),
                'path' => $path,
                'field' => $settings->name,
                'uniqueid' => $this->uniqueid
            ])
        ];

        // Return JSON
        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit;
    }

    /**
     * Return an error message for a PHP file upload error code
     * https://www.php.net/manual/en/features.file-upload.errors.php
     *
     * @param int $error PHP file upload error code
     * @param Language|null $language
     * @return string File upload error message
     */
    public function getFileUploadError(int $error, Language $language = null): string
    {
        if (!$language) {
            $grav = Grav::instance();

            /** @var Language $language */
            $language = $grav['language'];
        }

        switch ($error) {
            case UPLOAD_ERR_OK:
                $item = 'FILEUPLOAD_ERR_OK';
                break;
            case UPLOAD_ERR_INI_SIZE:
                $item = 'FILEUPLOAD_ERR_INI_SIZE';
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $item = 'FILEUPLOAD_ERR_FORM_SIZE';
                break;
            case UPLOAD_ERR_PARTIAL:
                $item = 'FILEUPLOAD_ERR_PARTIAL';
                break;
            case UPLOAD_ERR_NO_FILE:
                $item = 'FILEUPLOAD_ERR_NO_FILE';
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $item = 'FILEUPLOAD_ERR_NO_TMP_DIR';
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $item = 'FILEUPLOAD_ERR_CANT_WRITE';
                break;
            case UPLOAD_ERR_EXTENSION:
                $item = 'FILEUPLOAD_ERR_EXTENSION';
                break;
            default:
                $item = 'FILEUPLOAD_ERR_UNKNOWN';
        }
        return $language->translate('PLUGIN_FORM.'.$item);
    }

    /**
     * Removes a file from the flash object session, before it gets saved.
     *
     * @return void
     */
    public function filesSessionRemove(): void
    {
        $callable = function (): array {
            $field = $this->values->get('name');
            $filename = $this->values->get('filename');

            if (!isset($field, $filename)) {
                throw new RuntimeException('Bad Request: name and/or filename are missing', 400);
            }

            $this->removeFlashUpload($filename, $field);

            return ['status' => 'success'];
        };

        $this->sendJsonResponse($callable);
    }

    /**
     * @return void
     */
    public function storeState()
    {
        $callable = function (): array {
            $this->updateFlashData($this->values->get('data') ?? []);

            return ['status' => 'success'];
        };

        $this->sendJsonResponse($callable);
    }

    /**
     * @return void
     */
    public function clearState(): void
    {
        $callable = function (): array {
            $this->getFlash()->delete();

            return ['status' => 'success'];
        };

        $this->sendJsonResponse($callable);
    }

    /**
     * Handle form processing on POST action.
     *
     * @return void
     */
    public function post()
    {
        $grav = Grav::instance();

        /** @var Uri $uri */
        $uri = $grav['uri'];

        // Get POST data and decode JSON fields into arrays
        $post = $uri->post();
        $post['data'] = $this->decodeData($post['data'] ?? []);

        if ($post) {
            $this->values = new Data((array)$post);
            $data = $this->values->get('data');

            // Add post data to form dataset
            if (!$data) {
                $data = $this->values->toArray();
            }

            if (!$this->values->get('form-nonce') || !Utils::verifyNonce($this->values->get('form-nonce'), 'form')) {
                $this->status = 'error';
                $event = new Event(['form' => $this,
                    'message' => $grav['language']->translate('PLUGIN_FORM.NONCE_NOT_VALIDATED')
                ]);
                $grav->fireEvent('onFormValidationError', $event);

                return;
            }

            $i = 0;
            foreach ($this->items['fields'] as $key => $field) {
                $name = $field['name'] ?? $key;
                if (!isset($field['name'])) {
                    if (isset($data[$i])) { //Handle input@ false fields
                        $data[$name] = $data[$i];
                        unset($data[$i]);
                    }
                }
                if ($field['type'] === 'checkbox' || $field['type'] === 'switch') {
                    $data[$name] = isset($data[$name]) ? true : false;
                }
                $i++;
            }

            $this->data->merge($data);
        }

        // Validate and filter data
        try {
            $grav->fireEvent('onFormPrepareValidation', new Event(['form' => $this]));

            $this->data->validate();
            $this->data->filter();

            $grav->fireEvent('onFormValidationProcessed', new Event(['form' => $this]));
        } catch (ValidationException $e) {
            $this->status = 'error';
            $event = new Event(['form' => $this, 'message' => $e->getMessage(), 'messages' => $e->getMessages()]);
            $grav->fireEvent('onFormValidationError', $event);
            if ($event->isPropagationStopped()) {
                return;
            }
        } catch (RuntimeException $e) {
            $this->status = 'error';
            $event = new Event(['form' => $this, 'message' => $e->getMessage(), 'messages' => []]);
            $grav->fireEvent('onFormValidationError', $event);
            if ($event->isPropagationStopped()) {
                return;
            }
        }

        $redirect = $redirect_code = null;
        $process = $this->items['process'] ?? [];
        $legacyUploads = !isset($process['upload']) || $process['upload'] !== false;

        if ($legacyUploads) {
            $this->legacyUploads();
        }

        if (is_array($process)) {
            foreach ($process as $action => $data) {
                if (is_numeric($action)) {
                    $action = key($data);
                    $data = $data[$action];
                }

                // do not execute action, if deactivated
                if (false === $data) {
                    continue;
                }

                $event = new Event(['form' => $this, 'action' => $action, 'params' => $data]);
                $grav->fireEvent('onFormProcessed', $event);

                if ($event['redirect']) {
                    $redirect = $event['redirect'];
                    $redirect_code = $event['redirect_code'];
                }
                if ($event->isPropagationStopped()) {
                    break;
                }
            }
        }

        if ($legacyUploads) {
            $this->copyFiles();
        }

        $this->getFlash()->delete();

        if ($redirect) {
            $grav->redirect($redirect, $redirect_code);
        }
    }

    /**
     * @return string
     * @deprecated 3.0 Use $form->getName() instead
     */
    public function name(): string
    {
        return $this->getName();
    }

    /**
     * @return array
     * @deprecated 3.0 Use $form->getFields() instead
     */
    public function fields(): array
    {
        return $this->getFields();
    }

    /**
     * @return PageInterface
     * @deprecated 3.0 Use $form->getPage() instead
     */
    public function page(): PageInterface
    {
        return $this->getPage();
    }

    /**
     * Backwards compatibility
     *
     * @return void
     * @deprecated 3.0 Calling $form->filter() is not needed anymore (does nothing)
     */
    public function filter(): void
    {
    }

    /**
     * Store form uploads to the final location.
     *
     * @return void
     */
    public function copyFiles()
    {
        // Get flash object in order to save the files.
        $flash = $this->getFlash();
        $fields = $flash->getFilesByFields();

        foreach ($fields as $key => $uploads) {
            /** @var FormFlashFile $upload */
            foreach ($uploads as $upload) {
                if (null === $upload || $upload->isMoved()) {
                    continue;
                }

                $destination = $upload->getDestination();

                $filesystem = Filesystem::getInstance();
                $folder = $filesystem->dirname($destination);

                if (!is_dir($folder) && !@mkdir($folder, 0777, true) && !is_dir($folder)) {
                    $grav = Grav::instance();
                    throw new RuntimeException(sprintf($grav['language']->translate('PLUGIN_FORM.FILEUPLOAD_UNABLE_TO_MOVE', null, true), '"' . $upload->getClientFilename() . '"', $destination));
                }

                try {
                    $upload->moveTo($destination);
                } catch (RuntimeException $e) {
                    $grav = Grav::instance();
                    throw new RuntimeException(sprintf($grav['language']->translate('PLUGIN_FORM.FILEUPLOAD_UNABLE_TO_MOVE', null, true), '"' . $upload->getClientFilename() . '"', $destination));
                }
            }
        }

        $flash->clearFiles();
    }

    /**
     * @return void
     */
    public function legacyUploads()
    {
        // Get flash object in order to save the files.
        $flash = $this->getFlash();
        $queue = $verify = $flash->getLegacyFiles();

        if (!$queue) {
            return;
        }

        $grav = Grav::instance();

        /** @var Uri $uri */
        $uri = $grav['uri'];

        // Get POST data and decode JSON fields into arrays
        $post = $uri->post();
        $post['data'] = $this->decodeData($post['data'] ?? []);

        // Allow plugins to implement additional / alternative logic
        $grav->fireEvent('onFormStoreUploads', new Event(['form' => $this, 'queue' => &$queue, 'post' => $post]));

        $modified = $queue !== $verify;

        if (!$modified) {
            // Fill file fields just like before.
            foreach ($queue as $key => $files) {
                foreach ($files as $destination => $file) {
                    unset($files[$destination]['tmp_name']);
                }

                $this->setImageField($key, $files);
            }
        } else {
            user_error('Event onFormStoreUploads is deprecated.', E_USER_DEPRECATED);

            if (is_array($queue)) {
                foreach ($queue as $key => $files) {
                    foreach ($files as $destination => $file) {
                        $filesystem = Filesystem::getInstance();
                        $folder = $filesystem->dirname($destination);

                        if (!is_dir($folder) && !@mkdir($folder, 0777, true) && !is_dir($folder)) {
                            $grav = Grav::instance();
                            throw new RuntimeException(sprintf($grav['language']->translate('PLUGIN_FORM.FILEUPLOAD_UNABLE_TO_MOVE', null, true), '"' . $file['tmp_name'] . '"', $destination));
                        }

                        if (!rename($file['tmp_name'], $destination)) {
                            $grav = Grav::instance();
                            throw new RuntimeException(sprintf($grav['language']->translate('PLUGIN_FORM.FILEUPLOAD_UNABLE_TO_MOVE', null, true), '"' . $file['tmp_name'] . '"', $destination));
                        }

                        if (file_exists($file['tmp_name'] . '.yaml')) {
                            unlink($file['tmp_name'] . '.yaml');
                        }

                        unset($files[$destination]['tmp_name']);
                    }

                    $this->setImageField($key, $files);
                }
            }

            $flash->clearFiles();
        }
    }

    /**
     * @param string $path
     * @return string
     */
    public function getPagePathFromToken($path)
    {
        return Utils::getPagePathFromToken($path, $this->getPage());
    }

    /**
     * @return Route|null
     */
    public function getFileUploadAjaxRoute(): ?Route
    {
        $route = Uri::getCurrentRoute()->withExtension('json')->withGravParam('task', 'file-upload');

        return $route;
    }

    /**
     * @param string|null $field
     * @param string|null $filename
     * @return Route|null
     */
    public function getFileDeleteAjaxRoute($field = null, $filename = null): ?Route
    {
        $route = Uri::getCurrentRoute()->withExtension('json')->withGravParam('task', 'file-remove');

        return $route;
    }

    /**
     * @param int|null $code
     * @return int|mixed
     */
    public function responseCode($code = null)
    {
        if ($code) {
            $this->response_code = $code;
        }
        return $this->response_code;
    }

    /**
     * @return array
     */
    public function doSerialize()
    {
        return $this->doTraitSerialize() + [
                'items' => $this->items,
                'message' => $this->message,
                'status' => $this->status,
                'header_data' => $this->header_data,
                'rules' => $this->rules,
                'values' => $this->values->toArray(),
                'page' => $this->page
            ];
    }

    /**
     * @param array $data
     * @return void
     */
    public function doUnserialize(array $data)
    {
        $this->items = $data['items'];
        $this->message = $data['message'];
        $this->status = $data['status'];
        $this->header_data = $data['header_data'];
        $this->rules = $data['rules'];
        $this->values = new Data($data['values']);
        $this->page = $data['page'];

        // Backwards compatibility.
        $defaults = [
            'name' => $this->items['name'],
            'id' => $this->items['id'],
            'uniqueid' => $this->items['uniqueid'] ?? null,
            'data' => []
        ];

        $this->doTraitUnserialize($data + $defaults);
    }

    /**
     * Get the configured max file size in bytes
     *
     * @param bool $mbytes return size in MB
     * @return int
     */
    public static function getMaxFilesize($mbytes = false)
    {
        $config = Grav::instance()['config'];

        $system_filesize = 0;
        $form_filesize = $config->get('plugins.form.files.filesize', 0);
        $upload_limit = (int) Utils::getUploadLimit();

        if ($upload_limit > 0) {
            $system_filesize = intval($upload_limit / static::BYTES_TO_MB);
        }

        if ($form_filesize > $system_filesize || $form_filesize == 0) {
            $form_filesize = $system_filesize;
        }

        if ($mbytes) {
            return $form_filesize * static::BYTES_TO_MB;
        }

        return $form_filesize;
    }

    /**
     * @param callable $callable
     * @return void
     */
    protected function sendJsonResponse(callable $callable)
    {
        $grav = Grav::instance();

        /** @var Uri $uri */
        $uri  = $grav['uri'];

        // Get POST data and decode JSON fields into arrays
        $post = $uri->post();
        $post['data'] = $this->decodeData($post['data'] ?? []);

        if (empty($post['form-nonce']) || !Utils::verifyNonce($post['form-nonce'], 'form')) {
            throw new RuntimeException('Bad Request: Nonce is missing or invalid', 400);
        }

        $this->values = new Data($post);

        $json_response = $callable($post);

        // Return JSON
        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit;
    }

    /**
     * Remove uploaded file from flash object.
     *
     * @param string $filename
     * @param string|null $field
     * @return void
     */
    protected function removeFlashUpload(string $filename, string $field = null)
    {
        $flash = $this->getFlash();
        $flash->removeFile($filename, $field);
        $flash->save();
    }

    /**
     * Store updated data into flash object.
     *
     * @param array $data
     * @return void
     */
    protected function updateFlashData(array $data)
    {
        // Store updated data into flash.
        $flash = $this->getFlash();

        // Check special case where there are no changes made to the form.
        if (!$flash->exists() && $data === $this->header_data) {
            return;
        }

        $this->setAllData($flash->getData() ?? []);

        $this->data->merge($data);

        $flash->setData($this->data->toArray());
        $flash->save();
    }

    /**
     * @param array $data
     * @param array $files
     * @return void
     */
    protected function doSubmit(array $data, array $files)
    {
        return;
    }

    /**
     * @param array $fields
     * @return array
     */
    protected function processFields($fields)
    {
        $types = Grav::instance()['plugins']->formFieldTypes;

        $return = [];
        foreach ($fields as $key => $value) {
            // Default to text if not set
            if (!isset($value['type'])) {
                $value['type'] = 'text';
            }

            // Manually merging the field types
            if ($types !== null && array_key_exists($value['type'], $types)) {
                $value += $types[$value['type']];
            }

            // Fix numeric indexes
            if (is_numeric($key) && isset($value['name'])) {
                $key = $value['name'];
            }

            // Recursively process children
            if (isset($value['fields']) && is_array($value['fields'])) {
                $value['fields'] = $this->processFields($value['fields']);
            }

            $return[$key] = $value;
        }

        return $return;
    }

    /**
     * @param string $key
     * @param array $files
     * @return void
     */
    protected function setImageField($key, $files)
    {
        $field = $this->data->blueprints()->schema()->get($key);

        if (isset($field['type']) && !empty($field['array'])) {
            $this->data->set($key, $files);
        }
    }

    /**
     * Decode data
     *
     * @param array $data
     * @return array
     */
    protected function decodeData($data)
    {
        if (!is_array($data)) {
            return [];
        }

        // Decode JSON encoded fields and merge them to data.
        if (isset($data['_json'])) {
            $data = array_replace_recursive($data, $this->jsonDecode($data['_json']));
            unset($data['_json']);
        }

        $data = $this->cleanDataKeys($data);

        return $data;
    }

    /**
     * Decode [] in the data keys
     *
     * @param array $source
     * @return array
     */
    protected function cleanDataKeys($source = [])
    {
        $out = [];

        if (is_array($source)) {
            foreach ($source as $key => $value) {
                $key = str_replace(['%5B', '%5D'], ['[', ']'], $key);
                if (is_array($value)) {
                    $out[$key] = $this->cleanDataKeys($value);
                } else {
                    $out[$key] = $value;
                }
            }
        }

        return $out;
    }

    /**
     * Internal method to normalize the $_FILES array
     *
     * @param array  $data $_FILES starting point data
     * @param string $key
     * @return object a new Object with a normalized list of files
     */
    protected function normalizeFiles($data, $key = '')
    {
        $files = new stdClass();
        $files->field = $key;
        $files->file = new stdClass();

        foreach ($data as $fieldName => $fieldValue) {
            // Since Files Upload are always happening via Ajax
            // we are not interested in handling `multiple="true"`
            // because they are always handled one at a time.
            // For this reason we normalize the value to string,
            // in case it is arriving as an array.
            $value = (array) Utils::getDotNotation($fieldValue, $key);
            $files->file->{$fieldName} = array_shift($value);
        }

        return $files;
    }
}
