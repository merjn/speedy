<?php

declare(strict_types=1);

namespace Merjn\Speedy\Logger;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\ResettableInterface;
use Psr\Log\LoggerInterface;

class MonologFactory implements LogFactoryInterface
{
    public function create(string $name): LoggerInterface&ResettableInterface
    {
        return tap(new Logger($name), function (Logger $logger) {
            // TODO: Make this configurable
            $logger->pushHandler(new StreamHandler('php://stdout'));
        });
    }
}