<?php

namespace Merjn\Speedy\Contracts\Network\Session;

interface SessionInterface
{
    /**
     * Get the session id.
     *
     * @return mixed
     */
    public function getId(): mixed;
}