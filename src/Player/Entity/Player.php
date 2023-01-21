<?php

declare(strict_types=1);

namespace Merjn\Speedy\Player\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'players')]
class Player
{
    #[Column(type: 'integer')]
    #[Id]
    private readonly int $id;

    #[Column(type: 'string')]
    private readonly string $username;
}