<?php

declare(strict_types=1);

namespace Merjn\Speedy\Contracts\Communication;

use Merjn\Speedy\Communication\ServerMessageDelimiter;

interface RequestInterface extends HasSessionInterface
{
    /**
     * Get the packet header.
     *
     * @return string
     */
    public function getPacketHeader(): string;

    /**
     * Get a packet message.
     *
     * @param int $index
     * @param ServerMessageDelimiter $delimiter
     * @return string
     */
    public function get(int $index, ServerMessageDelimiter $delimiter = ServerMessageDelimiter::Space): string;

    /**
     * Get a value from the packet message.
     *
     * @param int $index
     * @param ServerMessageDelimiter $delimiter
     * @return string
     */
    public function getKvString(int $index, ServerMessageDelimiter $delimiter = ServerMessageDelimiter::CarriageReturn): string;

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
    public function getBodyLength(): int;

    /**
     * Get the amount of remaining messages.
     *
     * @return int
     */
    public function getLength(): int;
}