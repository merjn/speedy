<?php

declare(strict_types=1);

namespace Merjn\Speedy\Player\Presentation\Controller\Login;

use Merjn\Speedy\Contracts\Network\Session\SessionInterface;
use Merjn\Speedy\Contracts\Network\Session\SessionServiceInterface;
use Merjn\Speedy\Controller\AbstractController;
use Merjn\Speedy\Player\Application\Login\ValidateLoginAction;
use Merjn\Speedy\Player\Presentation\Request\Login\PlayerLoginRequest;

/**
 * Class PlayerLoginController handles the login request from the client.
 *
 * @package Merjn\Speedy\Player\Presentation\Controller
 */
final class PlayerLoginController extends AbstractController
{
    public function __construct(
        private readonly ValidateLoginAction $validateLogin,
        private readonly SessionServiceInterface $sessionService
    ) { }

    /**
     * Handle the login request.
     *
     * @param SessionInterface $session
     * @param PlayerLoginRequest $request
     * @return void
     */
    public function __invoke(SessionInterface $session, PlayerLoginRequest $request): void
    {
        if (!$this->validateLogin->validate($request->getUsername(), $request->getPassword())) {
            // TODO: Send a message to the client?
            $this->sessionService->kill($session);
            return;
        }

        // Get rooms
    }
}