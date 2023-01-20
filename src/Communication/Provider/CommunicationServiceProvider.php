<?php

declare(strict_types=1);

namespace Merjn\Speedy\Communication\Provider;

use League\Container\ServiceProvider\AbstractServiceProvider;
use Merjn\Speedy\Communication\RequestFactory;
use Merjn\Speedy\Contracts\Communication\RequestFactoryInterface;

class CommunicationServiceProvider extends AbstractServiceProvider
{

    public function provides(string $id): bool
    {
        return $id === RequestFactoryInterface::class;
    }

    public function register(): void
    {
        $this->getContainer()->add(RequestFactoryInterface::class, function () {
            return new RequestFactory();
        });
    }
}