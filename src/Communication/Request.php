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
     * @var string contains the packet header.
     */
    private string $header;

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
        $this->determineHeader();
    }

    private function determineRequestLength(): void
    {
        $this->requestLength = substr($this->packetBuffer, 0, 4);
        $this->packetBuffer = substr($this->packetBuffer, 4);
    }

    private function determineHeader(): void
    {
        if (!str_contains($this->packetBuffer, " ")) {
            $this->header = $this->packetBuffer;
            $this->packetBuffer = ""; // done
        } else {
            $this->header = substr($this->packetBuffer, 0, strpos($this->packetBuffer, " "));
            $this->packetBuffer = substr($this->packetBuffer, strpos($this->packetBuffer, " ") + 1);
        }
    }

    public function getPacketHeader(): string
    {
        return $this->header;
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

    public function hasBody(): bool
    {
        return strlen($this->packetBuffer) > 0;
    }

    public function getMessageCount(): int
    {
        return count(explode(ServerMessageDelimiter::Space->value, $this->packetBuffer));
    }

    public function get(int $index, ServerMessageDelimiter $delimiter = ServerMessageDelimiter::Space): string
    {
        $messages = explode($delimiter->value, $this->packetBuffer);

        if (!isset($messages[$index])) {
            throw new \OutOfBoundsException("The message index {$index} does not exist.");
        }

        return $messages[$index];
    }
}