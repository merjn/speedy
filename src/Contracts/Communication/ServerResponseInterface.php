<?php

declare(strict_types=1);

namespace Merjn\Speedy\Contracts\Communication;

interface ServerResponseInterface
{
    /**
     * Add a server message to the response.
     *
     * @param ServerBodyInterface $serverMessage
     * @return self
     */
    public function add(ServerBodyInterface $serverMessage): self;

    /**
     * Get the server messages.
     *
     * @return ServerBodyInterface[]
     */
    public function getMessages(): array;
}