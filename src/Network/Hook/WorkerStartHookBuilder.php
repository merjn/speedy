<?php

declare(strict_types=1);

namespace Merjn\Speedy\Network\Hook;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use OpenSwoole\Server;
use Psr\Log\LoggerInterface;

class WorkerStartHookBuilder implements HookBuilderInterface
{
    public function __construct(
        private readonly LoggerInterface $logger = new Logger(WorkerStartHookBuilder::class, [new StreamHandler('php://stdout')]),
    ) { }

    public function __invoke(): Hook
    {
        return new Hook('WorkerStart', function (Server $server, int $workerId): void {
            $this->logger->info("Socket worker {$workerId} started");
        });
    }
}