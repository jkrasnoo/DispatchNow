<?php

/**
 * Session configuration
 *   -- Captain Obvious
 */

return [
    'session_config' => [
        'name' => 'disp',
        'gc_maxlifetime' => 7200,
        'cookie_domain'  => '.dispatchmanagement.loc',
        'use_cookies' => true
    ],
    'session_storage' => [
        'type' => \Laminas\Session\Storage\SessionArrayStorage::class
    ],
    'session' => [
        'validators' => [
            Laminas\Session\Validator\HttpUserAgent::class,
            Laminas\Session\Validator\RemoteAddr::class
        ]
    ],
    'session_save_handler' => [
        'cache' => 'Dispatch\Cache'
    ]
];