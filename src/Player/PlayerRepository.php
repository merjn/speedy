<?php

declare(strict_types=1);

namespace Merjn\Speedy\Player;

use Doctrine\ORM\EntityRepository;
use Merjn\Speedy\Contracts\Player\PlayerRepositoryInterface;
use Merjn\Speedy\Player\Entity\Player;

class PlayerRepository extends EntityRepository implements PlayerRepositoryInterface
{

    public function getPlayerByName(string $username): ?Player
    {
        return $this->createQueryBuilder('r')
            ->select('r')
            ->from(Player::class, 'b')
            ->where('b.username = :username')
            ->setParameter('username', $username)
            ->getQuery()
            ->getResult()[0] ?? null;
    }
}