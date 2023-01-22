<?php

declare(strict_types=1);


namespace Merjn\Speedy\Communication;

use Merjn\Speedy\Contracts\Communication\ServerBodyInterface;
use Merjn\Speedy\Contracts\Communication\ServerResponseInterface;

class ServerResponse implements ServerResponseInterface
{
    /**
     * @var array $serverMessages The server messages.
     */
    private array $serverMessages = [];

    public function add(ServerBodyInterface $serverMessage): self
    {
        $this->serverMessages[] = $serverMessage;

        return $this;
    }

    public function getMessages(): array
    {
        return $this->serverMessages;
    }
}