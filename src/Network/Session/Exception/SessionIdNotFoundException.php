<?php

namespace Merjn\Speedy\Network\Session;

class SessionIdNotFoundException extends \Exception
{
    public function __construct(
        private readonly mixed $id,
    ) {
        parent::__construct("Session with id {$id} not found.");
    }

    public function getId(): mixed
    {
        return $this->id;
    }
}