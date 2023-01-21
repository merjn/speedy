<?php

declare(strict_types=1);

namespace Merjn\App\Application\Registration;

use Merjn\Speedy\Contracts\Player\PlayerRepositoryInterface;

class UsernameExistsAction
{
    public function __construct(
        private readonly PlayerRepositoryInterface $playerRepository
    ) { }

    public function __invoke(string $username): bool
    {
        return $this->playerRepository->getPlayerByName($username) !== null;
    }
}