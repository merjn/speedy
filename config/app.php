<?php

declare(strict_types=1);

return [
    'app' => [
        'network' => [
            'server' => '0.0.0.0',
            'port' => 30001,
        ],

        'packet' => [
            'logging' => [
                'enabled' => true,
            ],
        ],

        'providers' => [
            \Merjn\App\Presentation\Middleware\MiddlewareServiceProvider::class,
            \Merjn\Speedy\Communication\Provider\CommunicationServiceProvider::class,
            \Merjn\Speedy\Routing\Provider\RouteServiceProvider::class,
            \Merjn\Speedy\Network\Session\Provider\SessionServiceProvider::class,
            \Merjn\Speedy\Network\Provider\NetworkServiceProvider::class,
        ],
    ],
];