<?php

declare(strict_types=1);

namespace Merjn\Speedy\Communication;

use Merjn\Speedy\Contracts\Communication\ServerMessageFactoryInterface;
use Merjn\Speedy\Contracts\Communication\ServerBodyInterface;

class ServerMessageFactory implements ServerMessageFactoryInterface
{
    public function createFromHeader(string $header): ServerBodyInterface
    {
        return new ServerBody($header);
    }
}