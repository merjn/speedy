<?php

declare(strict_types=1);

namespace Merjn\Speedy\Communication;

use Merjn\Speedy\Contracts\Communication\RequestFactoryInterface;
use Merjn\Speedy\Contracts\Communication\RequestInterface;
use Merjn\Speedy\Contracts\Network\Session\SessionInterface;

class RequestFactory implements RequestFactoryInterface
{
    public function createRequest(SessionInterface $session, string $packetBuffer): RequestInterface
    {
        return new Request($session, $packetBuffer);
    }
}