<?php

declare(strict_types=1);

namespace Merjn\Speedy\Contracts\Communication;

interface RequestInterface extends HasSessionInterface
{
    /**
     * Get the packet header.
     *
     * @return string
     */
    public function getPacketHeader(): string;

    /**
     * Get a packet.
     *
     * @param int|string $packet
     * @return ?string
     */
    public function get(int|string $packet): ?string;

    /**
     * Check if there's still a packet body to read.
     *
     * @return bool
     */
    public function hasBody(): bool;

    /**
     * Get the body.
     *
     * @return array
     */
    public function getBody(): array;

    /**
     * Get the length of the packet. Retrieved from the first message in the packet.
     *
     * @return int
     */
    public function getRequestLength(): int;

    /**
     * Get the amount of remaining messages.
     *
     * @return int
     */
    public function getLength(): int;
}