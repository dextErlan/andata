<?php

namespace App;

use App\Controller\Action\CommentListAction;
use App\Controller\Action\CommentCreateAction;
use Aura\Router\RouterContainer;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HttpKernel
{
    private RouterContainer $routerContainer;
    private ServiceLocatorInterface $container;

    public function __construct(RouterContainer $routerContainer, ServiceLocatorInterface $container)
    {
        $this->routerContainer = $routerContainer;
        $this->container = $container;
        $this->setRoutes();
    }

    private function setRoutes()
    {
        $map = $this->routerContainer->getMap();

        // add a route to the map, and a handler for it
        $map->get('comment-list', '/api/comment', CommentListAction::class);
        $map->post('comment-create', '/api/comment', CommentCreateAction::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $matcher = $this->routerContainer->getMatcher();

        $route = $matcher->match($request);
        if (!$route) {
            return new JsonResponse(["Страница не найдена!"], 404);
        }

        foreach ($route->attributes as $key => $val) {
            $request = $request->withAttribute($key, $val);
        }

        $action = $this->container->get($route->handler);

        return $action->handle($request);
    }
}