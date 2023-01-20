<?php

namespace Merjn\Speedy\Routing\Builder;

class Route
{
    /**
     * Create a new route.
     *
     * @param string $header
     * @param string $controller
     * @param string $action
     * @param array $middleware
     */
    public function __construct(
        private readonly string $header,
        private readonly string $controller,
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
     * @return string
     */
    public function getController(): string
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
     * @return array
     */
    public function getMiddleware(): array
    {
        return $this->middleware;
    }
}