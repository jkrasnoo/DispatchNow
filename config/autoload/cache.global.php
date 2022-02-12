<?php

declare(strict_types=1);

return [
    'caches' => [
        'Dispatch\Cache' => [
            'adapter' => [
                'name' => 'memcached',
                'options' => [
                    'servers' => [
                        [
                            'host' => '127.0.0.1',
                            'port' => 11211
                        ]
                    ],
                ]
            ]
        ]
    ]
];