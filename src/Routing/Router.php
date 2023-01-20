<?php

declare(strict_types=1);

namespace Merjn\Speedy\Routing;

use Merjn\Speedy\Contracts\Routing\RouteRepositoryInterface;
use Merjn\Speedy\Routing\Exceptions\UndefinedRouteException;

class Router
{
    public function __construct(
        private readonly RouteRepositoryInterface $routeRepository
    ) { }

    /**
     * Dispatch a specific route.
     *
     * @param string $header
     * @return void
     * @throws UndefinedRouteException if the route is not defined.
     */
    public function dispatch(string $header): void
    {
        if (!is_null($route = $this->routeRepository->get($header))) {

        }

        throw new UndefinedRouteException($header);
    }
}