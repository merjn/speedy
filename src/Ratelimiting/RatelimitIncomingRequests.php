<?php

declare(strict_types=1);

namespace Merjn\Speedy\Ratelimiting;

use Merjn\Speedy\Contracts\Middleware\MiddlewareInterface;
use Merjn\Speedy\Contracts\Network\RequestInterface;

class RatelimitIncomingRequests implements MiddlewareInterface
{

    public function process(RequestInterface $request): RequestInterface
    {
        // TODO: Implement process() method.
    }
}