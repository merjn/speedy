<?php

declare(strict_types=1);

namespace Merjn\Speedy\Routing;

use Merjn\Speedy\Contracts\Communication\RequestInterface;
use Merjn\Speedy\Contracts\Communication\ServerResponseInterface;
use Merjn\Speedy\Contracts\Middleware\MiddlewareInterface;
use Merjn\Speedy\Contracts\Middleware\RequestHandlerInterface;

class RouteExecutionMiddleware implements MiddlewareInterface
{
    public function __construct(
        private readonly InstantiatedRoute $route
    ) { }

    public function process(RequestInterface $request, RequestHandlerInterface $next): ServerResponseInterface
    {
        $controller = $this->route->getController();

        // We won't allow method injection through the container. At least, not for now. There's currently
        // no use case and therefore no need for it. If you need it, feel free to open a PR.
        $controller->{$this->route->getAction()}($request);

        return $next->handle($request);
    }
}