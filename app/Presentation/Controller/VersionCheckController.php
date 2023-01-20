<?php

declare(strict_types=1);

namespace Merjn\App\Presentation\Controller;

use Merjn\Speedy\Communication\ServerResponse;
use Merjn\Speedy\Contracts\Communication\RequestInterface;
use Merjn\Speedy\Contracts\Communication\ServerResponseInterface;

class VersionCheckController
{
    public function __invoke(RequestInterface $request): ServerResponseInterface
    {
        return new ServerResponse();
    }
}