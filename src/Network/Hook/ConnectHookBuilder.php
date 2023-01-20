<?php

declare(strict_types=1);

namespace Merjn\Speedy\Network\Hook;

use Merjn\Speedy\Contracts\Network\Session\SessionFactoryInterface;
use Merjn\Speedy\Contracts\Network\Session\SessionRepositoryInterface;
use OpenSwoole\Server;

class ConnectHookBuilder implements HookBuilderInterface
{
    public function __construct(
        private readonly SessionFactoryInterface $sessionFactory,
        private readonly SessionRepositoryInterface $sessionRepository
    ) { }

    public function __invoke(): Hook
    {
        return new Hook('connect', function (Server $server, int $fd): void {
            $this->sessionRepository->add($this->sessionFactory->createSession($fd));

            $server->send($fd, "#HELLO##");
        });
    }
}