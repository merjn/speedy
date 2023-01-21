<?php

declare(strict_types=1);

namespace Merjn\App\Presentation\Response\Handshake;

use Merjn\Speedy\Communication\ServerMessage;

class SecretKeyResponse extends ServerMessage
{
    public function __construct(string $secretKey)
    {
        parent::__construct('SECRET_KEY');

        $this->newString($secretKey);
    }
}