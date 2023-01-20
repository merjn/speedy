<?php

namespace Merjn\Speedy\Contracts\Network\Session;

interface SessionServiceInterface
{
    /**
     * Join the network.
     *
     * @param SessionInterface $session
     * @return void
     */
    public function join(SessionInterface $session): void;

    /**
     * Kill the session
     *
     * @param SessionInterface $session
     * @return void
     */
    public function kill(SessionInterface $session): void;
}