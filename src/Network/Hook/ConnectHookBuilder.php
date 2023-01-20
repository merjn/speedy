<?php

declare(strict_types=1);

namespace Merjn\Speedy\Network\Hook;

use Merjn\Speedy\Contracts\Network\Session\SessionRepositoryInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use OpenSwoole\Server;
use Psr\Log\LoggerInterface;

class ConnectHookBuilder implements HookBuilderInterface
{
    public function __construct(
        private readonly SessionRepositoryInterface $sessionRepository,
        private readonly LoggerInterface $logger = new Logger('ConnectHookBuilder', [new StreamHandler('php://stdout')])
    ) { }

    public function __invoke(): Hook
    {
        return new Hook('connect', function (Server $server, int $fd): void {
            $this->logger->info("Client connected: {$fd}");
            dump($fd);
            $server->send($fd, "#HELLO##");

//            $this->sessionRepository->add($fd, new Session($fd));
        });
    }
}