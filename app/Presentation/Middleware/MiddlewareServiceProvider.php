<?php

declare(strict_types=1);

namespace Merjn\App\Presentation\Middleware;

use League\Container\ServiceProvider\AbstractServiceProvider;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class MiddlewareServiceProvider extends AbstractServiceProvider
{

    public function provides(string $id): bool
    {
        return $id === LogRequestMiddleware::class;
    }

    public function register(): void
    {
        $this->getContainer()->add(LogRequestMiddleware::class, function () {
            return new LogRequestMiddleware(new Logger(LogRequestMiddleware::class, [new StreamHandler('php://stdout')]));
        });
    }
}