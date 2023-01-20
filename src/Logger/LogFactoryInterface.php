<?php

declare(strict_types=1);

namespace Merjn\Speedy\Logger;

use Monolog\ResettableInterface;
use Psr\Log\LoggerInterface;

interface LogFactoryInterface
{
    /**
     * Create a new logger instance.
     *
     * @param string $name
     * @return LoggerInterface&ResettableInterface
     */
    public function create(string $name): LoggerInterface&ResettableInterface;
}