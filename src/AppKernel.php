<?php

declare(strict_types=1);

namespace Merjn\Speedy;

use League\Config\Configuration;
use League\Container\Container;
use Merjn\Speedy\Network\ServerBootstrap;

class AppKernel
{
    public const ASCII_LOGO = <<<LOGO
   ___     _ __                      _     _  _  
  / __|   | '_ \   ___     ___    __| |   | || | 
  \__ \   | .__/  / -_)   / -_)  / _` |    \_, | 
  |___/   |_|__   \___|   \___|  \__,_|   _|__/  
_|"""""|_|"""""|_|"""""|_|"""""|_|"""""|_| """"| 
"`-0-0-'"`-0-0-'"`-0-0-'"`-0-0-'"`-0-0-'"`-0-0-' 
LOGO;

    public function __construct(
        private readonly Container $container,
        private readonly Configuration $configuration
    ) { }

    /**
     * Boot the application.
     *
     * @return void
     */
    public function boot(): void
    {
        print(self::ASCII_LOGO);
        print("*vroem vroem*");
        print("\n\n");
        print("Speedy is a Habbo v1 emulator written in PHP.\n");

        $this->loadServiceProviders();
        $this->startSocketServer();
    }

    /**
     * Load all service providers.
     *
     * @return void
     */
    private function loadServiceProviders(): void
    {
        foreach ($this->configuration->get('app.providers') as $provider) {
            $this->container->addServiceProvider(new $provider);
        }
    }

    /**
     * Start the socket server.
     *
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    private function startSocketServer(): void
    {
        $this->container->get(ServerBootstrap::class)->start();
    }
}