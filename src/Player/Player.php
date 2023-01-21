<?php

declare(strict_types=1);

namespace Merjn\Speedy\Player;

class Player
{
    public function __construct(
        private readonly int $id,
        private readonly string $username,
        private readonly string $password,
        private readonly string $email,
        private readonly string $gender,
        private readonly string $figure,
        private readonly string $motto
    ) { }
}