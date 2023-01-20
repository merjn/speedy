<?php

declare(strict_types=1);

namespace Merjn\Speedy\Routing;

use Merjn\Speedy\Contracts\Communication\RequestInterface;
use Merjn\Speedy\Contracts\Communication\ServerResponseInterface;
use Merjn\Speedy\Contracts\Middleware\MiddlewareInterface;
use Merjn\Speedy\Contracts\Middleware\RequestHandlerInterface;

class MiddlewareDispatcher implements RequestHandlerInterface
{
    /**
     * @param MiddlewareInterface[] $middleware
     */
    public function __construct(
        private array $middleware
    ) { }

    /**
     * Handle the request.
     *
     * @param RequestInterface $request
     * @return ServerResponseInterface
     * @throws \Exception
     */
    public function handle(RequestInterface $request): ServerResponseInterface
    {
        $middleware = array_shift($this->middleware);
        if (!is_null($middleware)) {
            return $middleware->process($request, $this);
        }

        throw new \Exception('No middleware left to handle the request.');
    }
}