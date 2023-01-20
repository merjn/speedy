<?php

declare(strict_types=1);

namespace Merjn\Speedy\Network\Session;

use Merjn\Speedy\Contracts\Network\Session\SessionInterface;
use Merjn\Speedy\Contracts\Network\Session\SessionRepositoryInterface;
use Merjn\Speedy\Sync\Mutex;
use SplObjectStorage;

class MemorySessionRepository implements SessionRepositoryInterface
{
    /**
     * Contains all sessions. The key is the session id.
     *
     * @var array<mixed, SessionInterface>
     */
    private array $sessions;

    /**
     * Keep track of the sessions that are currently in use by the server using the SplObjectStorage, so that
     * we can get the session id from the session object.
     *
     * @var SplObjectStorage <Session, mixed>
     */
    private SplObjectStorage $sessionsFromStorage;

    /**
     * @var Mutex $mx
     */
    private Mutex $mx;

    public function __construct()
    {
        $this->sessions = [];
        $this->sessionsFromStorage = new SplObjectStorage();

        $this->mx = new Mutex();
    }

    /**
     * {@inheritDoc}
     *
     * @throws SessionIdNotFoundException When the session id is not found.
     */
    public function getById(mixed $id): SessionInterface
    {
        return $this->mx->synchronize(function () use ($id): Session {
            return $this->sessions[$id] ?? throw new SessionIdNotFoundException($id);
        });
    }

    public function add(SessionInterface $session): void
    {
        $this->mx->synchronize(function () use ($session) {
            $this->sessions[$session->getId()] = $session;
            $this->sessionsFromStorage->attach($session, $session->getId());
        });
    }
}