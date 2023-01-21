<?php

declare(strict_types=1);

namespace Merjn\Speedy\Player\Application\Provider;

use League\Container\ServiceProvider\AbstractServiceProvider;
use Merjn\Speedy\Contracts\Player\PlayerRepositoryInterface;
use Merjn\Speedy\Player\Application\Registration\CreateUserAction;
use Merjn\Speedy\Player\Application\Registration\UsernameExistsAction;
use Merjn\Speedy\Player\Application\Registration\VerifyUsernameAction;

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

        $this->getContainer()->add(UsernameExistsAction::class, function () {
            return new UsernameExistsAction($this->getContainer()->get(PlayerRepositoryInterface::class));
        });

        $this->getContainer()->add(CreateUserAction::class, function () {
            return new CreateUserAction(
                $this->getContainer()->get(VerifyUsernameAction::class),
                $this->getContainer()->get(UsernameExistsAction::class)
            );
        });
    }
}