<?php

declare(strict_types=1);

namespace Merjn\Speedy\Routing;

use Merjn\Speedy\Contracts\Routing\RouteRepositoryInterface;

final class RouteRepository implements RouteRepositoryInterface
{
    public function __construct(
        private readonly array $routes
    ) { }

    public function get(string $header): ?InstantiatedRoute
    {
        // TODO: Implement get() method.
    }
}