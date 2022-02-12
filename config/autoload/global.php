<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return [
    // ...
    'db' => [
        'adapters' => [
            'Application\Db\WriteAdapter' => [
                'driver' => 'Pdo',
                'dsn' => 'mysql:dbname=dispatch_management;host=localhost;charset=utf8',
                'username' => 'dispatch_control',
                'password' => 'n6ynan6hga',
                'driver_options' => [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
                ],
            ],
            'Application\Db\ReadAdapter' => [
                'driver' => 'Pdo',
                'dsn' => 'mysql:dbname=dispatch_management;host=localhost;charset=utf8',
                'username' => 'dispatch_control',
                'password' => 'n6ynan6hga',
                'driver_options' => [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
                ],
            ]
        ]
    ],
    'service_manager' => [
        'factories' => [
            'Application\Db\WriteAdapter' => \Laminas\Db\Adapter\AdapterAbstractServiceFactory::class,
            'Application\Db\ReadAdapter' => \Laminas\Db\Adapter\AdapterAbstractServiceFactory::class,
            'Laminas\Session\Config\ConfigInterface' => \Laminas\Session\Service\SessionConfigFactory::class,
            'Laminas\Session\SaveHandler\SaveHandlerInterface' => \Application\Service\CacheSessionSaveHandlerFactory::class
        ]
    ]
];
