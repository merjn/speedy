<?php

declare(strict_types=1);

namespace Merjn\Speedy\Contracts\Middleware;

use Merjn\Speedy\Contracts\Communication\RequestInterface;
use Merjn\Speedy\Contracts\Communication\ServerResponseInterface;

interface MiddlewareInterface
{
    /**
     * Process the middleware.
     *
     * @param RequestInterface $request
     * @param RequestHandlerInterface $next
     * @return ServerResponseInterface
     */
    public function process(RequestInterface $request, RequestHandlerInterface $next): ServerResponseInterface;
}