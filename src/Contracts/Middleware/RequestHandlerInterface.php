<?php

declare(strict_types=1);

namespace Merjn\Speedy\Contracts\Middleware;

use Merjn\Speedy\Contracts\Communication\RequestInterface;
use Merjn\Speedy\Contracts\Communication\ServerResponseInterface;

interface RequestHandlerInterface
{
    public function handle(RequestInterface $request): ServerResponseInterface;
}