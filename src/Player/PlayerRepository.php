<?php

declare(strict_types=1);

namespace Merjn\Speedy\Player;

use Doctrine\ORM\EntityRepository;
use Merjn\Speedy\Contracts\Player\PlayerRepositoryInterface;

class PlayerRepository extends EntityRepository implements PlayerRepositoryInterface
{

    public function getPlayerByName(string $username): Player
    {
        return $this->createQueryBuilder('r')
            ->select('r')
            ->from('Merjn\Speedy\Player\Player', 'r')
            ->where('r.username = :username')
            ->getQuery()
            ->getResult();
    }
}