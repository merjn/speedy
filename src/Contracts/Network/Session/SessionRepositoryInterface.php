<?php

namespace Merjn\Speedy\Contracts\Network\Session;

interface SessionRepositoryInterface
{
    /**
     * Add a new session.
     *
     * @param mixed $id
     * @param SessionInterface $session
     * @return void
     */
    public function add(mixed $id, SessionInterface $session): void;

    /**
     * Get a session object by id.
     *
     * @param mixed $id
     * @return SessionInterface
     */
    public function getById(mixed $id): SessionInterface;
}