<?php

namespace Merjn\Speedy\Network\Hook;

use Illuminate\Support\Collection;

class NetworkHooks
{
    public function __construct(
        public readonly Collection $hooks
    ) { }
}