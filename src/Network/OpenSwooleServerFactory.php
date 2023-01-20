<?php

declare(strict_types=1);

namespace Merjn\Speedy\Network;

use Illuminate\Support\Collection;
use Merjn\Speedy\Network\Config\NetworkConfig;
use Merjn\Speedy\Network\Hook\Hook;
use OpenSwoole\Server;

class OpenSwooleServerFactory
{
    public function __construct(
        private readonly NetworkConfig $config
    ) { }

    /**
     * Create a new server instance.
     *
     * @param Collection<Hook> $hooks
     * @return Server
     */
    public function create(Collection $hooks): Server
    {
        return tap(new Server(...$this->createServerConfig()), function (Server $server) use ($hooks): void {
            $hooks->each(fn (Hook $hook): bool => $server->on($hook->getEvent(), $hook->getCallback()));
        });
    }

    /**
     * Create the Swoole server config.
     *
     * @return array
     */
    private function createServerConfig(): array
    {
        return [$this->config->server, $this->config->port];
    }
}