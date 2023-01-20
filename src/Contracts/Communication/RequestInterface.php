<?php

declare(strict_types=1);

namespace Merjn\Speedy\Contracts\Communication;

use Merjn\Speedy\Contracts\Network\Session\SessionInterface;

interface RequestInterface
{
    /**
     * Get the user's session from the request.
     *
     * @return SessionInterface
     */
    public function getSession(): SessionInterface;

    /**
     * Get the packet header.
     *
     * @return string
     */
    public function getPacketHeader(): string;
}