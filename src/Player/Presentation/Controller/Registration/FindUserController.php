<?php

declare(strict_types=1);

namespace Merjn\Speedy\Player\Presentation\Controller\Registration;

use Merjn\Speedy\Communication\ServerResponse;
use Merjn\Speedy\Contracts\Communication\RequestInterface;
use Merjn\Speedy\Contracts\Communication\ServerResponseInterface;
use Merjn\Speedy\Player\Application\Registration\UsernameExistsAction;
use Merjn\Speedy\Player\Presentation\Traits\ExecutesInvokableActionTrait;

class FindUserController
{
    use ExecutesInvokableActionTrait;

    public function __construct(
        private readonly UsernameExistsAction $usernameExistsAction
    ) { }

    public function __invoke(RequestInterface $request): ServerResponseInterface
    {
        if (!$request->hasBody()) {
            return new ServerResponse();
        }

        $response = new ServerResponse();

        $this->executeAction($this->usernameExistsAction, [$request->get(0)]);

        return $response;
    }
}