<?php

declare(strict_types=1);

namespace Merjn\Speedy\Contracts\Communication;

use Merjn\Speedy\Contracts\Network\Session\SessionInterface;

interface RequestFactoryInterface
{
    /**
     * Create a new request instance.
     *
     * @param SessionInterface $session
     * @param string $packetBuffer
     * @return RequestInterface
     */
    public function createRequest(SessionInterface $session, string $packetBuffer): RequestInterface;
}