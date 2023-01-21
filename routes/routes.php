<?php

declare(strict_types=1);

use Merjn\App\Presentation\Controller\Registration\ApproveNameController;
use Merjn\App\Presentation\Controller\VersionCheckController;
use Merjn\App\Presentation\Middleware\LogRequestMiddleware;
use Merjn\Speedy\Routing\Builder\RouteCollection;

$routes = new RouteCollection();

$routes->withMiddleware(LogRequestMiddleware::class, function (RouteCollection $routes): void {
    $routes->add('VERSIONCHECK', VersionCheckController::class);
    $routes->add('APPROVENAME', ApproveNameController::class);
});

return $routes;