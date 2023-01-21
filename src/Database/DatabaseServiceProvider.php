<?php

declare(strict_types=1);

namespace Merjn\Speedy\Database;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;
use League\Config\Configuration;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

class DatabaseServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    private array $entityPath = [
        __DIR__ . '/../../Player/Entity',
    ];

    private function getConfig(): Configuration
    {
        return $this->getContainer()->get(Configuration::class);
    }

    private function createDbParams(): array
    {
        return [
            'driver'   => $this->getConfig()->get('app.database.db_driver'),
            'user'     => $this->getConfig()->get('app.database.user'),
            'password' => $this->getConfig()->get('app.database.password'),
            'dbname'   => $this->getConfig()->get('app.database.dbname'),
        ];
    }

    public function provides(string $id): bool
    {
        return $id === EntityManagerInterface::class;
    }

    public function boot(): void
    {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            $this->entityPath,
            $this->getConfig()->get('app.database.dev_mode')
        );

        $this->getContainer()->add(EntityManagerInterface::class, function () use ($config) {
            return EntityManager::create($this->createDbParams(), $config);
        });
    }

    public function register(): void
    {

    }
}