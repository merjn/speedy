<?php

declare(strict_types=1);

namespace Merjn\Speedy\Contracts\Communication;

interface ServerMessageInterface
{
    /**
     * Create a new string.
     *
     * @param string $argument
     * @return void
     */
    public function newString(string $argument): void;

    /**
     * Get the server message.
     *
     * @return string
     */
    public function getServerMessage(): string;
}