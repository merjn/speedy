<?php

declare(strict_types=1);

namespace Merjn\Speedy\Network\Session;

use Merjn\Speedy\Contracts\Network\Session\SessionInterface;
use Merjn\Speedy\Contracts\Network\Session\SessionRepositoryInterface;
use Merjn\Speedy\Contracts\Network\Session\SessionServiceInterface;

final class SwooleSessionService implements SessionServiceInterface
{
    public function __construct(
        private readonly SessionRepositoryInterface $sessionRepository
    ) { }

    public function kill(SessionInterface $session): void
    {

    }

    public function join(SessionInterface $session): void
    {
        // TODO: Implement join() method.
    }
}