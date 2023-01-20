<?php

declare(strict_types=1);

namespace Merjn\Speedy\Routing;

use Merjn\Speedy\Contracts\Routing\RouteRepositoryInterface;
use Merjn\Speedy\Routing\Exceptions\UndefinedRouteException;

/**
 * Class FrontController handles the routing of the application. It will find the correct controller and action to
 * execute. It will also execute the middleware, if any.
 *
 * @package Merjn\Speedy\Routing
 */
class FrontController
{
    public function __construct(
        private readonly RouteRepositoryInterface $routeRepository,
        private readonly PacketRea
    ) { }

    /**
     * Execute a route.
     *
     * @param string $header
     * @return void
     * @throws UndefinedRouteException if the route is not defined.
     */
    public function __invoke(string $header): void
    {
        if (!is_null($route = $this->routeRepository->get($header))) {
            // Unpack method arguments from the request.
            $arguments = $this->getMethodArguments($route->getController(), $route->getAction());
        }

        throw new UndefinedRouteException($header);
    }

    /**
     * Get the method arguments.
     *
     * @param mixed $getController
     * @param string $getAction
     * @return array
     */
    private function getMethodArguments(mixed $getController, string $getAction): array
    {

    }
}