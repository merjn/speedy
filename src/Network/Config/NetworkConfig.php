<?php

namespace Merjn\Speedy\Network\Config;

class NetworkConfig
{
    public function __construct(
        public readonly string $server,
        public readonly int $port,
        public readonly int $workers = 4
    ) { }
}