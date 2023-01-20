<?php

declare(strict_types=1);

namespace Merjn\Speedy\Network\Hook;

class Hook
{
    public function __construct(
        private readonly string $event,
        private readonly \Closure $callback
    ) { }

    public function getEvent(): string
    {
        return $this->event;
    }

    public function getCallback(): \Closure
    {
        return $this->callback;
    }
}