<?php

declare(strict_types=1);

namespace Merjn\Speedy\Player\Application\Registration;

class VerifyUsernameAction
{
    private array $forbidden = [
        "MOD-",
        "ADMIN-",
    ];

    /**
     * Verify the username.
     *
     * @param string $username
     * @return bool
     */
    public function __invoke(string $username): bool
    {
        if (strlen($username) < 3) {
            return false;
        }

        foreach ($this->forbidden as $forbidden) {
            if (str_contains($username, $forbidden)) {
                return false;
            }
        }

        return true;
    }
}