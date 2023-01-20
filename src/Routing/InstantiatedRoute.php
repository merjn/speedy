<?php

declare(strict_types=1);

namespace Merjn\Speedy\Routing;

use Merjn\Speedy\Contracts\Middleware\MiddlewareInterface;

class InstantiatedRoute
{
    /**
     * @param string $header
     * @param object $controller
     * @param string $action
     * @param array<MiddlewareInterface> $middleware
     */
    public function __construct(
        private readonly string $header,
        private readonly object $controller,
        private readonly string $action,
        private readonly array $middleware = []
    ) { }

    /**
     * Get the header.
     *
     * @return string
     */
    public function getHeader(): string
    {
        return $this->header;
    }

    /**
     * Get the controller.
     *
     * @return mixed
     */
    public function getController(): object
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * Get the middleware.
     *
     * @return array<MiddlewareInterface>
     */
    public function getMiddleware(): array
    {
        return $this->middleware;
    }
}