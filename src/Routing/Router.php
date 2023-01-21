<?php

declare(strict_types=1);

namespace Merjn\Speedy\Routing;

use Merjn\Speedy\Contracts\Communication\RequestInterface;
use Merjn\Speedy\Contracts\Communication\ServerResponseInterface;
use Merjn\Speedy\Contracts\Routing\RouteRepositoryInterface;
use Merjn\Speedy\Routing\Exceptions\UndefinedRouteException;

class Router
{
    public function __construct(
        private readonly RouteRepositoryInterface $routeRepository
    ) { }

    /**
     * Dispatch a packet to the correct route.
     *
     * @param RequestInterface $request
     * @return ServerResponseInterface
     * @throws UndefinedRouteException
     */
    public function dispatch(RequestInterface $request): ServerResponseInterface
    {
        $header = $request->getPacketHeader();
        print("Got header $header");
        if (!is_null($route = $this->routeRepository->get($header))) {
            $middleware = $route->getMiddleware();
            $middleware[] = new RouteExecutionMiddleware($route);

            return (new MiddlewareDispatcher($middleware))->handle($request);
        }

        throw new UndefinedRouteException($header);
    }
}