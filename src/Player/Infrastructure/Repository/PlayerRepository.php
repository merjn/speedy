<?php

declare(strict_types=1);

namespace Merjn\Speedy\Player\Infrastructure\Repository;

use Doctrine\ORM\EntityRepository;
use Merjn\Speedy\Contracts\Player\PlayerRepositoryInterface;
use Merjn\Speedy\Player\Domain\Entity\Player;

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

    public function persist(Player $player): void
    {
        $this->getEntityManager()->persist($player);
        $this->getEntityManager()->flush();
    }
}