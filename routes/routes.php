<?php

declare(strict_types=1);

use Merjn\Speedy\Player\Presentation\Controller\Registration\ApproveNameController;
use Merjn\Speedy\Player\Presentation\Controller\Registration\CreateAccountController;
use Merjn\Speedy\Player\Presentation\Controller\Registration\FindUserController;
use Merjn\Speedy\Player\Presentation\Controller\VersionCheckController;
use Merjn\Speedy\Player\Presentation\Middleware\LogRequestMiddleware;
use Merjn\Speedy\Routing\Builder\RouteCollection;

$routes = new RouteCollection();

$routes->withMiddleware(LogRequestMiddleware::class, function (RouteCollection $routes): void {
    $routes->add('VERSIONCHECK', VersionCheckController::class);
    $routes->add('APPROVENAME', ApproveNameController::class);
    $routes->add('FINDUSER', FindUserController::class);
    $routes->add('REGISTER', CreateAccountController::class);
});

return $routes;