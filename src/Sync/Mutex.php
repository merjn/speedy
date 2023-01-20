<?php

namespace Merjn\Speedy\Sync;

use OpenSwoole\Lock;

class Mutex
{
    public function __construct(
        private readonly Lock $lock = new Lock()
    ) { }

    /**
     * Run an operation synchronously.
     *
     * @param \Closure $op
     * @return void
     */
    public function synchronize(\Closure $op): mixed
    {
        try {
            $this->lock->lock();

            return $op();
        } finally {
            // Release the lock after the operation has executed.
            $this->lock->unlock();
        }
    }
}