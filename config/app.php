<?php

declare(strict_types=1);

return [
    'app' => [
        'network' => [
            'server' => '0.0.0.0',
            'port' => 30001,
            'workers' => 5,
        ],

        'database' => [
            'db_driver' => 'pdo_mysql',
            'user' => 'merijn',
            'dbname' => 'speedydb',
            'password' => '123456',
            'dev_mode' => true,
        ],

        'packet' => [
            'logging' => [
                'enabled' => true,
            ],
        ],

        'providers' => [
            \Merjn\Speedy\Database\DatabaseServiceProvider::class,
            \Merjn\Speedy\Player\Provider\PlayerServiceProvider::class,
            \Merjn\Speedy\Player\Presentation\Middleware\MiddlewareServiceProvider::class,
            \Merjn\Speedy\Communication\Provider\CommunicationServiceProvider::class,
            \Merjn\Speedy\Player\Application\Provider\AppServiceProvider::class,
            \Merjn\Speedy\Routing\Provider\RouteServiceProvider::class,
            \Merjn\Speedy\Network\Session\Provider\SessionServiceProvider::class,
            \Merjn\Speedy\Network\Provider\NetworkServiceProvider::class,
        ],
    ],
];