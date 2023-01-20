<?php

declare(strict_types=1);

namespace Merjn\Speedy\Contracts\Middleware;

use Merjn\Speedy\Contracts\Network\RequestInterface;

interface MiddlewareInterface
{
    /**
     * Process the middleware.
     *
     * @param RequestInterface $request
     * @return RequestInterface
     */
    public function process(RequestInterface $request): RequestInterface;
}