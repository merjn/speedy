<?php

declare(strict_types=1);

namespace Merjn\Speedy\Routing\Provider\Concerns;

use Psr\Container\NotFoundExceptionInterface;
use ReflectionClass;
use ReflectionParameter;

trait LoadsControllersTrait
{
    /**
     * Load a controller and its dependencies.
     *
     * @param string $controllerClass
     * @return object
     * @throws NotFoundExceptionInterface
     * @throws \ReflectionException
     */
    private function loadController(string $controllerClass): object
    {
        $controller = new ReflectionClass($controllerClass);

        return $controller->newInstanceArgs($this->instantiateControllerParameters($controller));
    }

    /**
     * Instantiate a list of controller parameters.
     *
     * @param ReflectionClass $controller
     * @return array
     */
    private function instantiateControllerParameters(ReflectionClass $controller): array
    {
        return array_map(function (ReflectionParameter $parameter): object {
            return $this->getContainer()->get($parameter->getType()->getName());
        }, $controller->getConstructor()->getParameters());
    }
}