<?php

declare(strict_types=1);

namespace Merjn\Speedy\Network\Logging;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use OpenSwoole\Server;
use Psr\Log\LoggerInterface;

class OutgoingPacketLoggerDecorator extends Server
{
    public function __construct(
        private readonly Server $server,
        private readonly LoggerInterface $logger = new Logger('OutgoingPacketLogger', [new StreamHandler('php://stdout')])
    ) {
        parent::__construct($this->server->host, $this->server->port, $this->server->mode, $this->server->type);
    }

    public function send($fd, $data, int $serverSocket = -1): bool
    {
        $this->logger->debug("Sending packet to {$fd}: {$data}");

        return $this->server->send($fd, $data, $serverSocket);
    }
}