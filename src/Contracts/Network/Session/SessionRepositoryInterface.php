<?php

namespace Merjn\Speedy\Contracts\Network\Session;

interface SessionRepositoryInterface
{
    /**
     * Add a new session.
     *
     * @param SessionInterface $session
     * @return void
     */
    public function add(SessionInterface $session): void;

    /**
     * Get a session object by id.
     *
     * @param mixed $id
     * @return SessionInterface
     */
    public function getById(mixed $id): SessionInterface;
}