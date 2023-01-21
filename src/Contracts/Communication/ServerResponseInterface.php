<?php

declare(strict_types=1);

namespace Merjn\Speedy\Contracts\Communication;

interface ServerResponseInterface
{
    /**
     * Add a server message to the response.
     *
     * @param ServerMessageInterface $serverMessage
     * @return self
     */
    public function add(ServerMessageInterface $serverMessage): self;

    /**
     * Get the server messages.
     *
     * @return ServerMessageInterface[]
     */
    public function getMessages(): array;
}