<?php

declare(strict_types=1);

namespace Merjn\Speedy\Network\Exception;

class SessionIdNotFoundException extends \Exception
{
    public function __construct(mixed $id)
    {
        parent::__construct("Session with id {$id} not found");
    }
}