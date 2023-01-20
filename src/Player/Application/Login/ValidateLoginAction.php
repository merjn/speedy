<?php

declare(strict_types=1);

namespace Merjn\Speedy\Player\Application\Login;

class ValidateLoginAction
{
    public function __construct(
        private readonly CheckForBansAction $checkForBans
    ) { }

    /**
     * Validate the login credentials.
     *
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function validate(string $username, string $password): bool
    {
//        $this->checkForBans->execute($request);
    }
}