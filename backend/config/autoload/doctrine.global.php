<?php

return [
    'dependencies' => [
        'factories' => [
            Doctrine\ORM\EntityManagerInterface::class => \Roave\PsrContainerDoctrine\EntityManagerFactory::class,
        ],
    ],

    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driver_class' => \Doctrine\DBAL\Driver\PDO\MySQL\Driver::class,
                'params' => [
                    'host' => 'mysql',
                    'port' => '3306',
                    'user' => 'admin',
                    'password' => 'secret',
                    'dbname' => 'test_db',
                ],
            ],
        ],
        'driver' => [
            'orm_default' => [
                'class' => Doctrine\Persistence\Mapping\Driver\MappingDriverChain::class,
                'drivers' => [
                    'App\Entity' => 'entities',
                ],
            ],
            'entities' => [
                'class' => Doctrine\ORM\Mapping\Driver\AttributeDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../../src/Entity'],
            ],
        ],
    ],
];
