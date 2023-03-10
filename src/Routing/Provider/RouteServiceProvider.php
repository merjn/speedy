<?php

declare(strict_types=1);

namespace Merjn\Speedy\Routing\Provider;

use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Merjn\Speedy\Contracts\Routing\RouteRepositoryInterface;
use Merjn\Speedy\Routing\Builder\Route;
use Merjn\Speedy\Routing\Builder\RouteCollection;
use Merjn\Speedy\Routing\InstantiatedRoute;
use Merjn\Speedy\Routing\Router;
use Merjn\Speedy\Routing\RouteRepository;

class RouteServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    use Concerns\InstantiatesMiddlewareTrait;
    use Concerns\LoadsControllersTrait;

    protected array $provides = [
        Router::class,
    ];

    /**
     * Get the route collection.
     *
     * @return RouteCollection
     */
    protected function getRouteCollection(): RouteCollection
    {
        return require_once __DIR__ . '/../../../routes/routes.php';
    }

    protected function createInstantiatedRoutes(): array
    {
        return $this->getRouteCollection()->getRoutes()->map(function (Route $route): InstantiatedRoute {
            return new InstantiatedRoute(
                header: $route->getHeader(),
                controller: $this->loadController($route->getController()),
                action: $route->getAction(),
                middleware: $this->getMiddleware($route)->toArray(),
            );
        })->toArray();
    }

    /**
     * {@inheritdoc}
     */
    public function boot(): void
    {
        $this->getContainer()->addShared(RouteRepositoryInterface::class, function (): RouteRepository {
            return new RouteRepository($this->createInstantiatedRoutes());
        });
    }

    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        $this->getContainer()->add(Router::class, function (): Router {
            return new Router($this->getContainer()->get(RouteRepositoryInterface::class));
        });
    }

    public function provides(string $id): bool
    {
        return in_array($id, $this->provides);
    }
}