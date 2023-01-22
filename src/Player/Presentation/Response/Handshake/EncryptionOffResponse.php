<?php

declare(strict_types=1);

namespace Merjn\Speedy\Player\Presentation\Response\Handshake;

use Merjn\Speedy\Communication\ServerBody;

class EncryptionOffResponse extends ServerBody
{
    public function __construct()
    {
        parent::__construct('ENCRYPTION_OFF');
    }
}