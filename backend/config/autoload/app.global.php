<?php

use App\Controller\Action\CommentListAction;
use App\Controller\Action\CommentCreateAction;
use App\HttpKernel;
use Aura\Router\RouterContainer;
use Doctrine\ORM\EntityManagerInterface;
use Laminas\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Psr\Container\ContainerInterface;

return [
    'dependencies' => [
        'abstract_factories' => [
            ReflectionBasedAbstractFactory::class,
        ],
        'factories' => [
            HttpKernel::class => function (ContainerInterface $container, $requestedName) {
                $routerContainer = $container->get(RouterContainer::class);

                return new $requestedName($routerContainer, $container);
            },
            RouterContainer::class => InvokableFactory::class,
            // action
            CommentCreateAction::class => function (ContainerInterface $container, $requestedName) {
                $em = $container->get(EntityManagerInterface::class);

                return new $requestedName($em);
            },
            CommentListAction::class => function (ContainerInterface $container, $requestedName) {
                $em = $container->get(EntityManagerInterface::class);

                return new $requestedName($em);
            },
        ],
    ],
    'debug' => false,
];
