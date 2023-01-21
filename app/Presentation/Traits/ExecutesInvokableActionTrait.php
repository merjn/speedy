<?php

declare(strict_types=1);

namespace Merjn\App\Presentation\Traits;

trait ExecutesInvokableActionTrait
{
    public function executeAction(object $instance, array $parameters = []): mixed
    {
        if (!is_callable($instance)) {
            throw new \InvalidArgumentException('Unable to invoke action');
        }

        return $instance(...$parameters);
    }
}