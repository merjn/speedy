<?php

declare(strict_types=1);

namespace Merjn\App\Presentation\Middleware;

use League\Container\ServiceProvider\AbstractServiceProvider;

class MiddlewareServiceProvider extends AbstractServiceProvider
{

    public function provides(string $id): bool
    {
        return $id === LogRequestMiddleware::class;
    }

    public function register(): void
    {
        $this->getContainer()->add(LogRequestMiddleware::class, function () {
            return new LogRequestMiddleware();
        });
    }
}