<?php

declare(strict_types=1);

namespace Merjn\Speedy\Player\Presentation\Controller\Login;

use Merjn\Speedy\Communication\ServerResponse;
use Merjn\Speedy\Contracts\Communication\RequestInterface;
use Merjn\Speedy\Contracts\Communication\ServerResponseInterface;
use Merjn\Speedy\Player\Application\Login\VerifyCredentialsAction;
use Merjn\Speedy\Player\Presentation\Traits\ExecutesInvokableActionTrait;

class LoginController
{
    use ExecutesInvokableActionTrait;

    public function __construct(
        private VerifyCredentialsAction $verifyCredentialsAction
    ) { }

    /**
     * Authenticate the player.
     *
     * @param RequestInterface $request
     * @return ServerResponseInterface
     */
    public function __invoke(RequestInterface $request): ServerResponseInterface
    {
        if ($request->getMessageCount() < 2) {
            return new ServerResponse();
        }

        $username = $request->get(0);
        $password = $request->get(1);
    }
}