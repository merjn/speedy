<?php

declare(strict_types=1);

namespace Merjn\Speedy\Network\Session\Provider;

use League\Config\Configuration;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Merjn\Speedy\Contracts\Network\Session\SessionRepositoryInterface;
use Merjn\Speedy\Contracts\Network\Session\SessionServiceInterface;
use Merjn\Speedy\Network\Session\MemorySessionRepository;
use Merjn\Speedy\Network\Session\SwooleSessionService;

class SessionServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    /**
     * Get the current session driver.
     *
     * @return string
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    private function getSessionDriver(): string
    {
        return $this->getContainer()->get(Configuration::class)->get('session.driver');
    }

    /**
     * Boot the session repository.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->container->addShared(SessionRepositoryInterface::class, function (): SessionRepositoryInterface {
            return match($this->getSessionDriver()) {
                'memory' => new MemorySessionRepository(),
            };
        });

        $this->getContainer()->addShared(SessionServiceInterface::class, function (): SwooleSessionService {
            return new SwooleSessionService($this->getContainer()->get(SessionRepositoryInterface::class));
        });
    }

    public function provides(string $id): bool
    {
        return $id === SessionRepositoryInterface::class;
    }

    public function register(): void
    {
        // TODO: Implement register() method.
    }
}