<?php

declare(strict_types=1);

namespace Merjn\Speedy\Packet;

/**
 * Class PacketWriter is responsible for writing packets for the Habbo V1 protocol.
 */
class PacketWriter
{
    public function __construct(
        private string $buffer
    ) { }

    /**
     * Get the packet buffer.
     *
     * @return string
     */
    public function getBuffer(): string
    {
        // Return the buffer with the length prepended

        return $this->buffer . "##";
    }
}