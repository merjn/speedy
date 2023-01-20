<?php

declare(strict_types=1);

namespace Merjn\Speedy\Packet;

class PacketReader
{
    /**
     * Constructor method.
     * @param string $buffer contains the packet data
     */
    public function __construct(
        private readonly string $buffer
    ) { }


}