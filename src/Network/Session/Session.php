<?php

namespace Merjn\Speedy\Network\Session;

use Merjn\Speedy\Contracts\Network\Session\SessionInterface;

class Session implements SessionInterface
{
    public function __construct(
        private readonly mixed $id,
    ) { }

    public function getId(): mixed
    {
        return $this->id;
    }
}