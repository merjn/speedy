<?php

declare(strict_types=1);

namespace Merjn\Speedy\Player\Presentation\Request\Login;

use Merjn\Speedy\Contracts\Network\RequestInterface;

class PlayerLoginRequest implements RequestInterface
{
    public function getUsername(): string
    {
        return "";
    }

    public function getPassword(): string
    {
        return "";
    }
}