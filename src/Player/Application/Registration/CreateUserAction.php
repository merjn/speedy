<?php

declare(strict_types=1);

namespace Merjn\Speedy\Player\Application\Registration;

use Merjn\Speedy\Contracts\Player\PlayerRepositoryInterface;
use Merjn\Speedy\Player\Domain\Entity\Player;
use Merjn\Speedy\Player\Presentation\Traits\ExecutesInvokableActionTrait;

class CreateUserAction
{
    use ExecutesInvokableActionTrait;

    public function __construct(
        private readonly VerifyUsernameAction $verifyUsernameAction,
        private readonly UsernameExistsAction $usernameExistsAction,
        private readonly PlayerRepositoryInterface $playerRepository
    ) { }

    public function __invoke(CreateUserDto $createUserDto): void
    {
        if (!$this->executeAction($this->verifyUsernameAction, [$createUserDto->username])) {
            return;
        }

        if ($this->executeAction($this->usernameExistsAction, [$createUserDto->username])) {
            return;
        }

        $player = new Player(
            username: $createUserDto->username,
            password: $createUserDto->password,
            email: $createUserDto->email,
            gender: $createUserDto->sex,
            figure: $createUserDto->figure,
            motto: $createUserDto->motto
        );

        $this->playerRepository->persist($player);
    }
}