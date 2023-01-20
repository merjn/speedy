<?php

declare(strict_types=1);

namespace Merjn\Speedy\Contracts\Routing;

use Merjn\Speedy\Routing\InstantiatedRoute;

interface RouteRepositoryInterface
{
    /**
     * Get a route.
     *
     * @param string $header
     * @return Route|null
     */
    public function get(string $header): ?InstantiatedRoute;
}