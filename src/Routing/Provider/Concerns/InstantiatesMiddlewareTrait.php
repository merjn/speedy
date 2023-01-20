<?php

declare(strict_types=1);

namespace Merjn\Speedy\Routing\Provider\Concerns;

use Illuminate\Support\Collection;
use Merjn\Speedy\Contracts\Middleware\MiddlewareInterface;
use Merjn\Speedy\Routing\Builder\Route;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

trait InstantiatesMiddlewareTrait
{
    /**
     * @var array<string, MiddlewareInterface> contains the class name of the middleware as the key and the instantiated middleware as the value.
     */
    private array $middleware = [];

    /**
     * Get the instantiated middleware for a route.
     *
     * @param Route $route
     * @return Collection
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function getMiddleware(Route $route): Collection
    {
        return collect($route->getMiddleware())->each(function (string $middlewareClass): MiddlewareInterface {
            return $this->middleware[$middlewareClass] ?? $this->loadMiddlewareClass($middlewareClass);
        });
    }

    /**
     * Load a middleware class.
     *
     * @param string $middlewareClass
     * @return MiddlewareInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    private function loadMiddlewareClass(string $middlewareClass): MiddlewareInterface
    {
        return tap($this->getContainer()->get($middlewareClass), function (MiddlewareInterface $middleware) use ($middlewareClass): void {
            $this->middleware[$middlewareClass] = $middleware;
        });
    }
}