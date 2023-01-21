<?php

declare(strict_types=1);

namespace Merjn\Speedy\Player\Provider;

use Doctrine\ORM\EntityManagerInterface;
use League\Container\ServiceProvider\AbstractServiceProvider;
use Merjn\Speedy\Contracts\Player\PlayerRepositoryInterface;
use Merjn\Speedy\Player\Entity\Player;
use Merjn\Speedy\Player\PlayerRepository;

class PlayerServiceProvider extends AbstractServiceProvider
{
    protected array $provides = [
        PlayerRepositoryInterface::class,
    ];

    public function provides(string $id): bool
    {
        return in_array($id, $this->provides);
    }

    public function register(): void
    {
        $this->getContainer()->add(PlayerRepositoryInterface::class, function () {
            return new PlayerRepository(
                $this->getContainer()->get(EntityManagerInterface::class),
                $this->getContainer()->get(EntityManagerInterface::class)->getClassMetadata(Player::class)
            );
        });
    }
}