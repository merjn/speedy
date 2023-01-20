<?php

declare(strict_types=1);

namespace Merjn\Speedy\Network\Hook;

use Merjn\Speedy\Contracts\Network\Session\SessionRepositoryInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

class OnReceiveHookBuilder implements HookBuilderInterface
{
    public function __construct(
        private readonly SessionRepositoryInterface $sessionRepository,
        private readonly LoggerInterface $logger = new Logger(OnReceiveHookBuilder::class, [new StreamHandler('php://stdout')])
    ) { }

    public function __invoke(): Hook
    {
        return new Hook('receive', function ($server, $fd, $reactorId, $data) {
            $this->logger->info("Received data from client {$fd}: {$data}");
        });
    }
}