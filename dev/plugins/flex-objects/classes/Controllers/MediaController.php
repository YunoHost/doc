<?php

declare(strict_types=1);

namespace Grav\Plugin\FlexObjects\Controllers;

use Exception;
use Grav\Common\Page\Interfaces\PageInterface;
use Grav\Common\Page\Medium\Medium;
use Grav\Common\Page\Medium\MediumFactory;
use Grav\Common\Utils;
use Grav\Framework\Flex\FlexObject;
use Grav\Framework\Flex\Interfaces\FlexAuthorizeInterface;
use Grav\Framework\Flex\Interfaces\FlexObjectInterface;
use Grav\Framework\Media\Interfaces\MediaInterface;
use LogicException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UploadedFileInterface;
use RocketTheme\Toolbox\Event\Event;
use RuntimeException;
use function is_array;
use function is_string;

/**
 * Class MediaController
 * @package Grav\Plugin\FlexObjects\Controllers
 */
class MediaController extends AbstractController
{
    /**
     * @return ResponseInterface
     */
    public function taskMediaUpload(): ResponseInterface
    {
        $this->checkAuthorization('media.create');

        $object = $this->getObject();
        if (null === $object) {
            throw new RuntimeException('Not Found', 404);
        }

        if (!method_exists($object, 'checkUploadedMediaFile')) {
            throw new RuntimeException('Not Found', 404);
        }

        // Get updated object from Form Flash.
        $flash = $this->getFormFlash($object);
        if ($flash->exists()) {
            $object = $flash->getObject() ?? $object;
            $object->update([], $flash->getFilesByFields());
        }

        // Get field for the uploaded media.
        $field = $this->getPost('name', 'undefined');
        if ($field === 'undefined') {
            $field = null;
        }

        $request = $this->getRequest();
        $files = $request->getUploadedFiles();
        if ($field && isset($files['data'])) {
            $files = $files['data'];
            $parts = explode('.', $field);
            $last = array_pop($parts);
            foreach ($parts as $name) {
                if (!is_array($files[$name])) {
                    throw new RuntimeException($this->translate('PLUGIN_ADMIN.INVALID_PARAMETERS'), 400);
                }
                $files = $files[$name];
            }
            $file = $files[$last] ?? null;

        } else {
            // Legacy call with name being the filename instead of field name.
            $file = $files['file'] ?? null;
            $field = null;
        }

        /** @var UploadedFileInterface $file */
        if (is_array($file)) {
            $file = reset($file);
        }

        if (!$file instanceof UploadedFileInterface) {
            throw new RuntimeException($this->translate('PLUGIN_ADMIN.INVALID_PARAMETERS'), 400);
        }

        $filename = $file->getClientFilename();

        $object->checkUploadedMediaFile($file, $filename, $field);

        try {
            // TODO: This only merges main level data, but is good for ordering (for now).
            $data = $flash->getData() ?? [];
            $data = array_replace($data, (array)$this->getPost('data'));

            $crop = $this->getPost('crop');
            if (is_string($crop)) {
                $crop = json_decode($crop, true, 512, JSON_THROW_ON_ERROR);
            }

            $flash->setData($data);
            $flash->addUploadedFile($file, $field, $crop);
            $flash->save();
        } catch (Exception $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
        }

        // Include exif metadata into the response if configured to do so
        $metadata = [];
        $include_metadata = $this->grav['config']->get('system.media.auto_metadata_exif', false);
        if ($include_metadata) {
            $medium = MediumFactory::fromUploadedFile($file);

            $media = $object->getMedia();
            $media->add($filename, $medium);

            $basename = str_replace(['@3x', '@2x'], '', Utils::pathinfo($filename, PATHINFO_BASENAME));
            if (isset($media[$basename])) {
                $metadata = $media[$basename]->metadata() ?: [];
            }
        }

        $response = [
            'code'    => 200,
            'status'  => 'success',
            'message' => $this->translate('PLUGIN_ADMIN.FILE_UPLOADED_SUCCESSFULLY'),
            'filename' => htmlspecialchars($filename, ENT_QUOTES | ENT_HTML5, 'UTF-8'),
            'metadata' => $metadata
        ];

        return $this->createJsonResponse($response);
    }

    public function taskMediaUploadMeta(): ResponseInterface
    {
        $this->checkAuthorization('media.create');

        $object = $this->getObject();
        if (null === $object) {
            throw new RuntimeException('Not Found', 404);
        }

        if (!method_exists($object, 'checkUploadedMediaFile')) {
            throw new RuntimeException('Not Found', 404);
        }

        // Get updated object from Form Flash.
        $flash = $this->getFormFlash($object);
        if ($flash->exists()) {
            $object = $flash->getObject() ?? $object;
            $object->update([], $flash->getFilesByFields());
        }

        // Get field and data for the uploaded media.
        $field = $this->getPost('field');
        $data = $this->getPost('data');
        $filename = Utils::basename($data['name']);

        $response = [
            'code'    => 200,
            'status'  => 'success',
            'message' => $this->translate('PLUGIN_ADMIN.FILE_UPLOADED_SUCCESSFULLY'),
            'field' => $field,
            'filename' => $filename,
            'metadata' => $data
        ];

        return $this->createJsonResponse($response);
    }

    /**
     * @return ResponseInterface
     */
    public function taskMediaDelete(): ResponseInterface
    {
        $this->checkAuthorization('media.delete');

        /** @var FlexObjectInterface|null $object */
        $object = $this->getObject();
        if (!$object) {
            throw new RuntimeException('Not Found', 404);
        }

        $filename = $this->getPost('filename');

        // Handle bad filenames.
        if (!Utils::checkFilename($filename)) {
            throw new RuntimeException($this->translate('PLUGIN_ADMIN.NO_FILE_FOUND'), 400);
        }

        try {
            $field = $this->getPost('name');
            $flash = $this->getFormFlash($object);
            $flash->removeFile($filename, $field);
            $flash->save();
        } catch (Exception $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
        }

        $response = [
            'code'    => 200,
            'status'  => 'success',
            'message' => $this->translate('PLUGIN_ADMIN.FILE_DELETED') . ': ' . htmlspecialchars($filename, ENT_QUOTES | ENT_HTML5, 'UTF-8')
        ];

        return $this->createJsonResponse($response);
    }

    /**
     * Used in pagemedia field.
     *
     * @return ResponseInterface
     */
    public function taskMediaCopy(): ResponseInterface
    {
        $this->checkAuthorization('media.create');

        /** @var FlexObjectInterface|null $object */
        $object = $this->getObject();
        if (!$object) {
            throw new RuntimeException('Not Found', 404);
        }

        if (!method_exists($object, 'uploadMediaFile')) {
            throw new RuntimeException('Not Found', 404);
        }

        $request = $this->getRequest();
        $files = $request->getUploadedFiles();

        $file = $files['file'] ?? null;
        if (!$file instanceof UploadedFileInterface) {
            throw new RuntimeException($this->translate('PLUGIN_ADMIN.INVALID_PARAMETERS'), 400);
        }

        $post = $request->getParsedBody();
        $filename = $post['name'] ?? $file->getClientFilename();

        // Upload media right away.
        $object->uploadMediaFile($file, $filename);

        // Include exif metadata into the response if configured to do so
        $metadata = [];
        $include_metadata = $this->grav['config']->get('system.media.auto_metadata_exif', false);
        if ($include_metadata) {
            $basename = str_replace(['@3x', '@2x'], '', Utils::pathinfo($filename, PATHINFO_BASENAME));
            $media = $object->getMedia();
            if (isset($media[$basename])) {
                $metadata = $media[$basename]->metadata() ?: [];
            }
        }

        if ($object instanceof PageInterface) {
            // Backwards compatibility to existing plugins.
            // DEPRECATED: page
            $this->grav->fireEvent('onAdminAfterAddMedia', new Event(['object' => $object, 'page' => $object]));
        }

        $response = [
            'code'    => 200,
            'status'  => 'success',
            'message' => $this->translate('PLUGIN_ADMIN.FILE_UPLOADED_SUCCESSFULLY'),
            'filename' => htmlspecialchars($filename, ENT_QUOTES | ENT_HTML5, 'UTF-8'),
            'metadata' => $metadata
        ];

        return $this->createJsonResponse($response);
    }


    /**
     * Used in pagemedia field.
     *
     * @return ResponseInterface
     */
    public function taskMediaRemove(): ResponseInterface
    {
        $this->checkAuthorization('media.delete');

        /** @var FlexObjectInterface|null $object */
        $object = $this->getObject();
        if (!$object) {
            throw new RuntimeException('Not Found', 404);
        }

        if (!method_exists($object, 'deleteMediaFile')) {
            throw new RuntimeException('Not Found', 404);
        }

        $filename = $this->getPost('filename');

        // Handle bad filenames.
        if (!Utils::checkFilename($filename)) {
            throw new RuntimeException($this->translate('PLUGIN_ADMIN.NO_FILE_FOUND'), 400);
        }

        $object->deleteMediaFile($filename);

        if ($object instanceof PageInterface) {
            // Backwards compatibility to existing plugins.
            // DEPRECATED: page
            $this->grav->fireEvent('onAdminAfterDelMedia', new Event(['object' => $object, 'page' => $object, 'media' => $object->getMedia(), 'filename' => $filename]));
        }

        $response = [
            'code'    => 200,
            'status'  => 'success',
            'message' => $this->translate('PLUGIN_ADMIN.FILE_DELETED') . ': ' . htmlspecialchars($filename, ENT_QUOTES | ENT_HTML5, 'UTF-8')
        ];

        return $this->createJsonResponse($response);
    }

    /**
     * @return ResponseInterface
     */
    public function actionMediaList(): ResponseInterface
    {
        $this->checkAuthorization('media.list');

        /** @var MediaInterface|FlexObjectInterface $object */
        $object = $this->getObject();
        if (!$object) {
            throw new RuntimeException('Not Found', 404);
        }

        // Get updated object from Form Flash.
        $flash = $this->getFormFlash($object);
        if ($flash->exists()) {
            $object = $flash->getObject() ?? $object;
            $object->update([], $flash->getFilesByFields());
        }

        $media = $object->getMedia();
        $media_list = [];

        /**
         * @var string $name
         * @var Medium $medium
         */
        foreach ($media->all() as $name => $medium) {
            $media_list[$name] = [
                'url' => $medium->display($medium->get('extension') === 'svg' ? 'source' : 'thumbnail')->cropZoom(400, 300)->url(),
                'size' => $medium->get('size'),
                'metadata' => $medium->metadata() ?: [],
                'original' => $medium->higherQualityAlternative()->get('filename')
            ];
        }

        $response = [
            'code' => 200,
            'status' => 'success',
            'results' => $media_list
        ];

        return $this->createJsonResponse($response);
    }

    /**
     * Used by the filepicker field to get a list of files in a folder.
     *
     * @return ResponseInterface
     */
    protected function actionMediaPicker(): ResponseInterface
    {
        $this->checkAuthorization('media.list');

        /** @var FlexObject $object */
        $object = $this->getObject();
        if (!$object || !\is_callable([$object, 'getFieldSettings'])) {
            throw new RuntimeException('Not Found', 404);
        }

        // Get updated object from Form Flash.
        $flash = $this->getFormFlash($object);
        if ($flash->exists()) {
            $object = $flash->getObject() ?? $object;
            $object->update([], $flash->getFilesByFields());
        }

        $name = $this->getPost('name');
        $settings = $name ? $object->getFieldSettings($name) : null;
        if (empty($settings['media_picker_field'])) {
            throw new RuntimeException('Not Found', 404);
        }

        $media = $object->getMediaField($name);

        $available_files = [];
        $metadata = [];
        $thumbs = [];

        /**
         * @var string $name
         * @var Medium $medium
         */
        foreach ($media->all() as $name => $medium) {
            $available_files[] = $name;

            if (isset($settings['include_metadata'])) {
                $img_metadata = $medium->metadata();
                if ($img_metadata) {
                    $metadata[$name] = $img_metadata;
                }
            }

        }

        // Peak in the flashObject for optimistic filepicker updates
        $pending_files = [];
        $sessionField = base64_encode($this->grav['uri']->url());
        $flash = $this->getSession()->getFlashObject('files-upload');
        $folder = $media->getPath() ?: null;

        if ($flash && isset($flash[$sessionField])) {
            foreach ($flash[$sessionField] as $field => $data) {
                foreach ($data as $file) {
                    $test = \dirname($file['path']);
                    if ($test === $folder) {
                        $pending_files[] = $file['name'];
                    }
                }
            }
        }

        $this->getSession()->setFlashObject('files-upload', $flash);

        // Handle Accepted file types
        // Accept can only be file extensions (.pdf|.jpg)
        if (isset($settings['accept'])) {
            $available_files = array_filter($available_files, function ($file) use ($settings) {
                return $this->filterAcceptedFiles($file, $settings);
            });

            $pending_files = array_filter($pending_files, function ($file) use ($settings) {
                return $this->filterAcceptedFiles($file, $settings);
            });
        }

        if (isset($settings['deny'])) {
            $available_files = array_filter($available_files, function ($file) use ($settings) {
                return $this->filterDeniedFiles($file, $settings);
            });

            $pending_files = array_filter($pending_files, function ($file) use ($settings) {
                return $this->filterDeniedFiles($file, $settings);
            });
        }

        // Generate thumbs if needed
        if (isset($settings['preview_images']) && $settings['preview_images'] === true) {
            foreach ($available_files as $filename) {
                $thumbs[$filename] = $media[$filename]->zoomCrop(100,100)->url();
            }
        }

        $response = [
            'code' => 200,
            'status' => 'success',
            'files' => array_values($available_files),
            'pending' => array_values($pending_files),
            'folder' => $folder,
            'metadata' => $metadata,
            'thumbs' => $thumbs
        ];

        return $this->createJsonResponse($response);
    }

    /**
     * @param string $file
     * @param array $settings
     * @return false|int
     */
    protected function filterAcceptedFiles(string $file, array $settings)
    {
        $valid = false;

        foreach ((array)$settings['accept'] as $type) {
            $find = str_replace('*', '.*', $type);
            $valid |= preg_match('#' . $find . '$#i', $file);
        }

        return $valid;
    }

    /**
     * @param string $file
     * @param array $settings
     * @return false|int
     */
    protected function filterDeniedFiles(string $file, array $settings)
    {
        $valid = true;

        foreach ((array)$settings['deny'] as $type) {
            $find = str_replace('*', '.*', $type);
            $valid = !preg_match('#' . $find . '$#i', $file);
        }

        return $valid;
    }

    /**
     * @param string $action
     * @return void
     * @throws LogicException
     * @throws RuntimeException
     */
    protected function checkAuthorization(string $action): void
    {
        $object = $this->getObject();
        if (!$object) {
            throw new RuntimeException('Not Found', 404);
        }

        // If object does not have ACL support ignore ACL checks.
        if (!$object instanceof FlexAuthorizeInterface) {
            return;
        }

        switch ($action) {
            case 'media.list':
                $action = 'read';
                break;

            case 'media.create':
            case 'media.delete':
                $action = $object->exists() ? 'update' : 'create';
                break;

            default:
                throw new LogicException(sprintf('Unsupported authorize action %s', $action), 500);
        }

        if (!$object->isAuthorized($action, null, $this->user)) {
            throw new RuntimeException('Forbidden', 403);
        }
    }
}
