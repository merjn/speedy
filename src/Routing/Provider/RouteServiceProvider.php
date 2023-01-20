<?php

declare(strict_types=1);

namespace Merjn\Speedy\Routing\Provider;

use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Merjn\Speedy\Contracts\Routing\RouteRepositoryInterface;
use Merjn\Speedy\Routing\Builder\Route;
use Merjn\Speedy\Routing\Builder\RouteCollection;
use Merjn\Speedy\Routing\InstantiatedRoute;
use Merjn\Speedy\Routing\FrontController;
use Merjn\Speedy\Routing\RouteRepository;

class RouteServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    use Concerns\InstantiatesMiddlewareTrait;
    use Concerns\LoadsControllersTrait;

    protected array $provides = [
        FrontController::class,
    ];

    /**
     * Get the route collection.
     *
     * @return RouteCollection
     */
    protected function getRouteCollection(): RouteCollection
    {
        return require_once __DIR__ . '/../../../routes.php';
    }

    /**
     * Get al
     * @return array
     */
    protected function createInstantiatedRoutes(): array
    {
        return $this->getRouteCollection()->getRoutes()->map(function (Route $route): InstantiatedRoute {
            return new InstantiatedRoute(
                header: $route->getHeader(),
                controller: $this->loadController($route->getController()),
                action: $route->getAction(),
                middleware: $this->getMiddleware($route)->toArray(),
            );
        });
    }

    /**
     * {@inheritdoc}
     */
    public function boot(): void
    {
        $this->getContainer()->addShared(RouteRepositoryInterface::class, function (): RouteRepository {
            return new RouteRepository($this->createInstantiatedRoutes());
        });

        $this->getContainer()->add(FrontController::class, function (): FrontController {
            return new FrontController($this->getContainer()->get(RouteRepositoryInterface::class));
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