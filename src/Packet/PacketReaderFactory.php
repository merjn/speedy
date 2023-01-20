<?php

declare(strict_types=1);

namespace Merjn\Speedy\Packet;

class PacketReaderFactory
{
    public function createPacketReaderFromBuffer(string $buffer): PacketReader
    {
        return new PacketReader($buffer);
    }
}