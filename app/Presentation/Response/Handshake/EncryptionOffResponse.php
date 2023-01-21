<?php

declare(strict_types=1);

namespace Merjn\App\Presentation\Response\Handshake;

use Merjn\Speedy\Communication\ServerMessage;

class EncryptionOffResponse extends ServerMessage
{
    public function __construct()
    {
        parent::__construct('ENCRYPTION_OFF');
    }
}