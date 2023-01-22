<?php

declare(strict_types=1);

namespace Merjn\Speedy\Communication;

use Merjn\Speedy\Communication\Concern\ParsesIncomingRequestTrait;
use Merjn\Speedy\Communication\Exception\MalformedRequestException;
use Merjn\Speedy\Contracts\Communication\RequestInterface;
use Merjn\Speedy\Contracts\Network\Session\SessionInterface;

/**
 * Class Request reads the request from the client. Normally, you'd see stuff like readString(), readInt() in
 * controllers, but because Request reads the packet a priori, the packet will always remain in the same state once it
 * is instantiated. This means that you can read the packet in any order you want, and you can read it multiple times.
 * This is useful for example when you want to read the packet in a middleware, and then again in a controller.
 *
 * @package Merjn\Speedy\Communication
 */
class Request implements RequestInterface
{
    use ParsesIncomingRequestTrait;

    /**
     * @var int contains the packet length.
     */
    private int $requestLength;

    /**
     * @var string contains the packet header.
     */
    private string $header;

    /**
     * @var array contains the arguments.
     */
    private array $body = [];

    /**
     * Create a new request instance.
     *
     * @param SessionInterface $session
     * @param string $packetBuffer
     * @throws MalformedRequestException
     */
    public function __construct(
        private readonly SessionInterface $session,
        private string $packetBuffer
    ){
        $this->parseRequestLength();
        $this->parseRequestHeader();
        $this->parseBody();
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
        return true;
    }

    public function getLength(): int
    {
        return count($this->body);
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function getRequestLength(): int
    {
        return $this->requestLength;
    }

    public function get(int|string $packet): ?string
    {
        return $this->body[$packet] ?? null;
    }
}