<?php

declare(strict_types=1);

namespace Merjn\Speedy\Player\Application\Registration;

class CreateUserDto
{
    public function __construct(
        public readonly string $username,
        public readonly string $password,
        public readonly string $email,
        public readonly string $figure,
        public readonly string $mail,
        public readonly string $birthday,
        public readonly string $sex,
        public readonly string $country,
    ) { }
}