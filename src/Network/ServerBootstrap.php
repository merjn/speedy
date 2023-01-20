<?php

declare(strict_types=1);

namespace Merjn\Speedy\Network;

use Merjn\Speedy\Network\Hook\NetworkHooks;

class ServerBootstrap
{
    public function __construct(
        private readonly OpenSwooleServerFactory $serverFactory,
        private readonly NetworkHooks $networkHooks
    ) { }

    public function start(): void
    {
        $this->serverFactory->create($this->networkHooks->hooks)->start();
    }
}