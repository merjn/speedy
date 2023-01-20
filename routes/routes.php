<?php

declare(strict_types=1);

use Merjn\Speedy\Player\Presentation\Controller\Login\PlayerLoginController;
use Merjn\Speedy\Ratelimiting\RatelimitIncomingRequests;
use Merjn\Speedy\Routing\Builder\RouteCollection;

$routes = new RouteCollection();

$routes->withMiddleware(RatelimitIncomingRequests::class, function (RouteCollection $routes): void {
    $routes->add('LOGIN', PlayerLoginController::class);
});

return $routes;