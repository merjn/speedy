<?php

declare(strict_types=1);

namespace Merjn\Speedy\Player\Application\Login;

use Merjn\Speedy\Contracts\Player\PlayerRepositoryInterface;

class VerifyCredentialsAction
{
    public function __construct(
        private readonly PlayerRepositoryInterface $playerRepository
    ) { }

    public function __invoke(string $username, string $password): bool
    {
        if (!is_null($player = $this->playerRepository->getPlayerByName($username))) {
           return $password == $player->getPassword();
        }

        return false;
    }
}