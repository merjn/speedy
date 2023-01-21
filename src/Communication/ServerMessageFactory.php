<?php

declare(strict_types=1);

namespace Merjn\Speedy\Communication;

use Merjn\Speedy\Contracts\Communication\ServerMessageFactoryInterface;
use Merjn\Speedy\Contracts\Communication\ServerMessageInterface;

class ServerMessageFactory implements ServerMessageFactoryInterface
{
    public function createFromHeader(string $header): ServerMessageInterface
    {
        return new ServerMessage($header);
    }
}