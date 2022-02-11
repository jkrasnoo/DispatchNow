<?php

declare(strict_types=1);

namespace Application;

use Application\Controller\Factory\RegistrationControllerFactory;
use Application\Controller\Factory\SecurityControllerFactory;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'security' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/security[/:action]',
                    'defaults' => [
                        'controller' => Controller\SecurityController::class,
                        'action'     => 'login',
                    ]
                ]
            ],
            'register' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/register[/:action]',
                    'defaults' => [
                        'controller' => Controller\RegistrationController::class,
                        'action' => 'index'
                    ]
                ]
            ],
            'dashboard' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/dashboard',
                    'defaults' => [
                        'controller' => Controller\DashboardController::class,
                        'action' => 'index'
                    ]
                ]
            ]
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\SecurityController::class => SecurityControllerFactory::class,
            Controller\RegistrationController::class => RegistrationControllerFactory::class
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];