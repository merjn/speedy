<?php

declare(strict_types=1);

namespace Merjn\Speedy\Player\Presentation\Response\Registration;

use Merjn\Speedy\Communication\ServerBody;

class NameUnacceptable extends ServerBody
{
    public function __construct()
    {
        parent::__construct('NAME_UNACCEPTABLE');
    }
}