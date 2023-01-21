<?php

declare(strict_types=1);

namespace Merjn\Speedy\Player\Presentation\Response\Registration;

use Merjn\Speedy\Communication\ServerMessage;

class NameUnacceptable extends ServerMessage
{
    public function __construct()
    {
        parent::__construct('NAME_UNACCEPTABLE');
    }
}