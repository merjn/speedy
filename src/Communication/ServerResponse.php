<?php

declare(strict_types=1);


namespace Merjn\Speedy\Communication;

use Merjn\Speedy\Contracts\Communication\ServerMessageInterface;
use Merjn\Speedy\Contracts\Communication\ServerResponseInterface;

class ServerResponse implements ServerResponseInterface
{
    /**
     * @var array $serverMessages The server messages.
     */
    private array $serverMessages = [];

    public function add(ServerMessageInterface $serverMessage): void
    {
        $this->serverMessages[] = $serverMessage;
    }

    public function getMessages(): array
    {
        return $this->serverMessages;
    }
}