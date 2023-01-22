<?php

declare(strict_types=1);

namespace Merjn\Speedy\Communication;

use Merjn\Speedy\Contracts\Communication\ServerBodyInterface;
use Merjn\Speedy\Contracts\Communication\ResponseBuilderInterface;
use Merjn\Speedy\Contracts\Communication\ServerResponseInterface;

class ResponseBuilder implements ResponseBuilderInterface
{
    private array $messages = [];

    public function add(ServerBodyInterface $body): void
    {
        $this->messages[] = $body;
    }

    public function buildServerResponse(): ServerResponseInterface
    {
        return new ServerResponse($this->messages);
    }
}