<?php

declare(strict_types=1);

namespace Merjn\Speedy\Network\Hook;

use Merjn\Speedy\Contracts\Network\Session\SessionRepositoryInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use OpenSwoole\Server;
use Psr\Log\LoggerInterface;

class OnCloseHookBuilder implements HookBuilderInterface
{
    public function __construct(
        private readonly SessionRepositoryInterface $sessionRepository,
        private readonly LoggerInterface $logger = new Logger(OnCloseHookBuilder::class, [new StreamHandler('php://stdout')]),
    ) { }

    public function __invoke(): Hook
    {
        return new Hook('close', function (Server $server, int $fd) {
            $this->logger->info("Worker {$server->worker_id} closed connection from {$fd}");

            $this->sessionRepository->remove($fd);
        });
    }
}