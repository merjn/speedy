<?php

declare(strict_types=1);

namespace Merjn\Speedy\Player\Application\Registration;

use Merjn\Speedy\Player\Presentation\Traits\ExecutesInvokableActionTrait;

class CreateUserAction
{
    use ExecutesInvokableActionTrait;

    public function __construct(
        private readonly VerifyUsernameAction $verifyUsernameAction,
        private readonly UsernameExistsAction $usernameExistsAction,
    ) { }

    public function __invoke(CreateUserDto $createUserDto): void
    {
        dump($createUserDto);

        if (!$this->executeAction($this->verifyUsernameAction, [$createUserDto->username])) {
            return;
        }

        if ($this->executeAction($this->usernameExistsAction, [$createUserDto->username])) {
            return;
        }


    }
}