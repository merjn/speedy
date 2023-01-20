<?php

declare(strict_types=1);

namespace Merjn\Speedy\Routing\Builder;

use Illuminate\Support\Collection;

class RouteCollection
{
    /**
     * @var Collection<Route|RouteCollection> contains a list of routes.
     */
    private Collection $routes;

    /**
     * Create a new instance of the route collection.
     *
     * @param array<string> $middleware contains a list of middleware that'll be applied to all routes.
     */
    public function __construct(
        private readonly array $middleware = []
    ) {
        $this->routes = new Collection();
    }

    /**
     * Create a new RouteCollection instance with grouped middleware.
     *
     * @param array|string $middleware
     * @param \Closure $callback
     * @return RouteCollection
     */
    public function withMiddleware(array|string $middleware, \Closure $callback): RouteCollection
    {
        $routeCollection = new RouteCollection(array_merge($this->middleware, $middleware));

        $callback($routeCollection);

        $this->routes->merge($routeCollection->toArray());

        return $routeCollection;
    }

    /**
     * Add a route.
     *
     * @param string $header
     * @param string|array $controllerClass
     * @return $this
     */
    public function add(string $header, string|array $controllerClass): self
    {
        [$controllerClass, $action] = is_array($controllerClass)
            ? $controllerClass
            : [$controllerClass, '__invoke'];

        $this->routes[$header] = new Route($header, $controllerClass, $action, $this->middleware);

        return $this;
    }

    /**
     * Get a route from the collection.
     *
     * @param string $header
     * @return ?Route
     */
    public function get(string $header): ?Route
    {
        return $this->routes[$header] ?? null;
    }

    /**
     * Get all route as an array.
     *
     * @return Route[]&RouteCollection[]
     */
    public function toArray(): array
    {
        return $this->routes->toArray();
    }

    /**
     * Get all routes.
     *
     * @return Collection
     */
    public function getRoutes(): Collection
    {
        return $this->routes;
    }
}