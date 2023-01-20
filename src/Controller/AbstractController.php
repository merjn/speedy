<?php

declare(strict_types=1);

namespace Merjn\Speedy\Controller;

use Merjn\Speedy\Contracts\Network\Session\SessionInterface;

abstract class AbstractController
{
    public abstract function __invoke(SessionInterface $session, mixed $request): void;
}