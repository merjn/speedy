<?php

declare(strict_types=1);

namespace Merjn\Speedy\Player\Presentation\Response\Handshake;

use Merjn\Speedy\Contracts\Communication\ServerBodyInterface;

class SecretKeyBody implements ServerBodyInterface
{
    public function __construct(
        private string $secretKey
    ) { }

    public function getBody(): string
    {
        return $this->getBody();
    }
}