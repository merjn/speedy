<?php

declare(strict_types=1);

namespace Merjn\Speedy\Contracts\Communication;

interface ServerBodyInterface
{
    /**
     * Get the server message.
     *
     * @return string
     */
    public function getBody(): string;
}