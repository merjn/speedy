<?php

declare(strict_types=1);

namespace Merjn\Speedy\Routing\Exceptions;

class UndefinedRouteException extends \Exception
{
    public function __construct(string $header)
    {
        parent::__construct("Route {$header} is not defined");
    }
}