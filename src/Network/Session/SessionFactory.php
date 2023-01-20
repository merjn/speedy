<?php

declare(strict_types=1);

namespace Merjn\Speedy\Network\Session;

use Merjn\Speedy\Contracts\Network\Session\SessionFactoryInterface;
use Merjn\Speedy\Contracts\Network\Session\SessionInterface;

class SessionFactory implements SessionFactoryInterface
{

    public function createSession(mixed $identifier): SessionInterface
    {
        return new Session($identifier);
    }
}