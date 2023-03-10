<?php

declare(strict_types=1);

namespace Merjn\Speedy\Network\Provider;

use Illuminate\Support\Collection;
use League\Config\Configuration;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Merjn\Speedy\Contracts\Communication\RequestFactoryInterface;
use Merjn\Speedy\Contracts\Network\Session\SessionFactoryInterface;
use Merjn\Speedy\Contracts\Network\Session\SessionRepositoryInterface;
use Merjn\Speedy\Network\Config\NetworkConfig;
use Merjn\Speedy\Network\Hook\ConnectHookBuilder;
use Merjn\Speedy\Network\Hook\NetworkHooks;
use Merjn\Speedy\Network\Hook\OnCloseHookBuilder;
use Merjn\Speedy\Network\Hook\OnReceiveHookBuilder;
use Merjn\Speedy\Network\Hook\WorkerStartHookBuilder;
use Merjn\Speedy\Network\Logging\OutgoingPacketLoggerDecorator;
use Merjn\Speedy\Network\OpenSwooleServerFactory;
use Merjn\Speedy\Network\ServerBootstrap;
use Merjn\Speedy\Routing\Router;

class NetworkServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    protected array $provides = [
        OpenSwooleServerFactory::class,
        NetworkHooks::class,
        ConnectHookBuilder::class,
        ServerBootstrap::class,
    ];

    public function boot(): void
    {
        $this->createOpenSwooleServerFactory();
        $this->createNetworkHooks();
        $this->createServerBootstrap();
    }

    /**
     * Create a new instance of the OpenSwooleServerFactory.
     *
     * @return void
     */
    protected function createOpenSwooleServerFactory(): void
    {
        $this->getContainer()->add(OpenSwooleServerFactory::class, fn () => new OpenSwooleServerFactory($this->createNetworkConfig()));
    }

    /**
     * Create all server hooks.
     *
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    protected function createNetworkHooks(): void
    {
        $hooks = new Collection([
            $this->addConnectionHook()(),
            $this->addOnReceiveHook()(),
            $this->addWorkerStartedHook()(),
            $this->addOnCloseHook()(),
        ]);

        $this->getContainer()->add(NetworkHooks::class, fn (): NetworkHooks => new NetworkHooks($hooks));
    }

    protected function addConnectionHook(): ConnectHookBuilder
    {
        $this->getContainer()->add(ConnectHookBuilder::class, function () {
            return new ConnectHookBuilder(
                $this->getContainer()->get(SessionFactoryInterface::class),
                $this->getContainer()->get(SessionRepositoryInterface::class)
            );
        });

        return $this->getContainer()->get(ConnectHookBuilder::class);
    }

    protected function addOnReceiveHook(): OnReceiveHookBuilder
    {
        $this->getContainer()->add(OnReceiveHookBuilder::class, function () {
            return new OnReceiveHookBuilder(
                $this->getContainer()->get(RequestFactoryInterface::class),
                $this->getContainer()->get(SessionRepositoryInterface::class),
                $this->getContainer()->get(Router::class)
            );
        });

        return $this->getContainer()->get(OnReceiveHookBuilder::class);
    }

    protected function addWorkerStartedHook(): WorkerStartHookBuilder
    {
        $this->getContainer()->add(WorkerStartHookBuilder::class, function () {
            return new WorkerStartHookBuilder();
        });

        return $this->getContainer()->get(WorkerStartHookBuilder::class);
    }

    protected function addOnCloseHook(): OnCloseHookBuilder
    {
        $this->getContainer()->add(OnCloseHookBuilder::class, function () {
            return new OnCloseHookBuilder(
                $this->getContainer()->get(SessionRepositoryInterface::class)
            );
        });

        return $this->getContainer()->get(OnCloseHookBuilder::class);
    }

    protected function createNetworkConfig(): NetworkConfig
    {
        $config = $this->getContainer()->get(Configuration::class);

        return new NetworkConfig(
            $config->get('app.network.server'),
            $config->get('app.network.port'),
            $config->get('app.network.workers')
        );
    }

    protected function createServerBootstrap(): void
    {
        $this->getContainer()->add(ServerBootstrap::class, function () {
            return new ServerBootstrap($this->getContainer()->get(OpenSwooleServerFactory::class), $this->getContainer()->get(NetworkHooks::class));
        });
    }

    /**
     * {@inheritdoc}
     */
    public function register(): void
    {

    }

    public function provides(string $id): bool
    {
        return in_array($id, $this->provides);
    }
}