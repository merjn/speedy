<?php

declare(strict_types=1);

namespace Merjn\App\Application\Provider;

use League\Container\ServiceProvider\AbstractServiceProvider;
use Merjn\App\Application\Registration\VerifyUsernameAction;

class AppServiceProvider extends AbstractServiceProvider
{
    protected array $provides = [
        VerifyUsernameAction::class,
    ];

    public function provides(string $id): bool
    {
        return in_array($id, $this->provides);
    }

    public function register(): void
    {
        $this->getContainer()->add(VerifyUsernameAction::class, function () {
            return new VerifyUsernameAction();
        });
    }
}