<?php

declare(strict_types=1);

namespace Merjn\Speedy\Contracts\Communication;

interface ServerMessageInterface
{
    /**
     * Initialize the server message.
     *
     * @param string $header
     * @return void
     */
    public function write(string $header): void;
}