<?php

namespace Merjn\Speedy\Contracts\Communication;

use Merjn\Speedy\Contracts\Network\Session\SessionInterface;

interface HasSessionInterface
{
    /**
     * Get the user's session from the request.
     *
     * @return SessionInterface
     */
    public function getSession(): SessionInterface;
}