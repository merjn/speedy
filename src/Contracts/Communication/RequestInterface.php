<?php

declare(strict_types=1);

namespace Merjn\Speedy\Contracts\Communication;

use Merjn\Speedy\Communication\ServerMessageDelimiter;
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

    /**
     * Get a packet message.
     *
     * @param int $index
     * @param ServerMessageDelimiter $delimiter
     * @return string
     */
    public function get(int $index, ServerMessageDelimiter $delimiter = ServerMessageDelimiter::Space): string;

    /**
     * Check if there's still a packet body to read.
     *
     * @return bool
     */
    public function hasBody(): bool;

    /**
     * Get the amount of remaining messages.
     *
     * @return int
     */
    public function getMessageCount(): int;
}