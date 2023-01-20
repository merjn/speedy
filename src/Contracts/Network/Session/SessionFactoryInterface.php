<?php

declare(strict_types=1);

namespace Merjn\Speedy\Contracts\Network\Session;

interface SessionFactoryInterface
{
    public function createSession(mixed $identifier): SessionInterface;
}