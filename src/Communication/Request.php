<?php

namespace Merjn\Speedy\Communication;

use Merjn\Speedy\Contracts\Communication\RequestInterface;
use Merjn\Speedy\Contracts\Network\Session\SessionInterface;

class Request implements RequestInterface
{
    /**
     * @var int contains the packet length.
     */
    private int $requestLength;

    /**
     * @var int is the position of the packet buffer.
     */
    private int $position = 0;

    /**
     * Create a new request instance.
     *
     * @param SessionInterface $session
     * @param string $packetBuffer
     */
    public function __construct(
        private readonly SessionInterface $session,
        private string $packetBuffer
    ){
        $this->determineRequestLength();
    }

    private function determineRequestLength(): void
    {
        $this->requestLength = substr($this->packetBuffer, 0, 4);
    }

    public function getPacketHeader(): string
    {
        return "";
    }

    /**
     * Get the session.
     *
     * @return SessionInterface
     */
    public function getSession(): SessionInterface
    {
        return $this->session;
    }
}