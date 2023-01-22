<?php

declare(strict_types=1);

namespace Merjn\Speedy\Player\Presentation\Controller\Registration;

use Merjn\Speedy\Communication\ServerResponse;
use Merjn\Speedy\Contracts\Communication\RequestInterface;
use Merjn\Speedy\Contracts\Communication\ServerResponseInterface;
use Merjn\Speedy\Player\Application\Registration\CreateUserAction;
use Merjn\Speedy\Player\Presentation\Traits\ExecutesInvokableActionTrait;

class CreateAccountController
{
    use ExecutesInvokableActionTrait;

    public function __construct(
        private readonly CreateUserAction $createUserAction
    ) { }

    public function __invoke(RequestInterface $request): ServerResponseInterface
    {
//        $dto = new CreateUserDto(
//            username: $request->getKvString(0),
//            password: $request->getKvString(1),
//            email: $request->getKvString(2),
//            figure: $request->getKvString(3),
//            mail: $request->getKvString(4),
//            birthday: $request->getKvString(5),
//            sex: $request->getKvString(9),
//            country: $request->getKvString(10),
//            motto: $request->getKvString(7)
//        );
//
//        $this->executeAction($this->createUserAction, [$dto]);

        return new ServerResponse();
    }
}