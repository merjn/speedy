<?php

declare(strict_types=1);

namespace Merjn\Speedy\Contracts\Player;

use Merjn\Speedy\Player\Domain\Entity\Player;

interface PlayerRepositoryInterface
{
    /**
     * Find a player.
     *
     * @param string $username
     * @return Player
     */
    public function getPlayerByName(string $username): ?Player;

    public function persist(Player $player): void;
}