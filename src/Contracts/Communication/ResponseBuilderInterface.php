<?php

declare(strict_types=1);

namespace Merjn\Speedy\Contracts\Communication;

interface ResponseBuilderInterface
{
    public function add(ServerBodyInterface $body): void;

    public function buildServerResponse(): ServerResponseInterface;
}