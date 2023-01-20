<?php

declare(strict_types=1);

namespace Merjn\App\Presentation\Middleware;

use Merjn\Speedy\Contracts\Communication\RequestInterface;
use Merjn\Speedy\Contracts\Communication\ServerResponseInterface;
use Merjn\Speedy\Contracts\Middleware\MiddlewareInterface;
use Merjn\Speedy\Contracts\Middleware\RequestHandlerInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

class LogRequestMiddleware implements MiddlewareInterface
{
    public function __construct(
        private readonly LoggerInterface $logger = new Logger(LogRequestMiddleware::class, [new StreamHandler('php://stdout')]),
    ) { }

    public function process(RequestInterface $request, RequestHandlerInterface $next): ServerResponseInterface
    {
        $this->logger->info('Request received', [
            'request' => $request,
        ]);

        return $next->handle($request);
    }
}