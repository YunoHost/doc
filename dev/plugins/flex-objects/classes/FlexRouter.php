<?php

namespace Grav\Plugin\FlexObjects;

use Grav\Framework\Route\Route;
use Grav\Plugin\FlexObjects\Controllers\MediaController;
use Grav\Plugin\FlexObjects\Controllers\ObjectController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Class FlexRouter
 * @package Grav\Plugin\FlexObjects
 */
class FlexRouter implements MiddlewareInterface
{
    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $context = $request->getAttributes();

        /** @var Route $route */
        $route = $context['route'];
        $post = $request->getParsedBody();

        $task = $post['task'] ?? $route->getParam('task');

        if (\in_array($task, ['cropupload', 'filesupload'])) {
            $task = 'media.upload';
        }

        switch ($task) {
            case 'media.upload':
            case 'media.delete':
            case 'media.copy':
            case 'media.remove':
            case 'media.list':

            case 'media.add':
            case 'listmedia':
            case 'addmedia':
            case 'delmedia':
                return (new MediaController())->handle($request);
            case 'save':
            case 'create':
            case 'update':
            case 'delete':
            case 'reset':
            case 'preview':

            case 'move':
                return (new ObjectController())->handle($request);
        }

        // No handler found.
        return $handler->handle($request);
    }
}
