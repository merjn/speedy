<?php

declare(strict_types=1);

namespace Merjn\Speedy\Contracts\Communication;

interface ServerMessageFactoryInterface
{
    /**
     * Create a new server message.
     *
     * @param string $header
     * @return ServerMessageInterface
     */
    public function createFromHeader(string $header): ServerMessageInterface;
}