<?php

declare(strict_types=1);

namespace Merjn\Speedy\Database;

use OpenSwoole\Core\Coroutine\Client\MysqliClient;
use OpenSwoole\Process\Pool;
use OpenSwoole\Server\Event;

class ConnectionPool
{
    public function __construct()
    {
        new RedisPool();

    }
}