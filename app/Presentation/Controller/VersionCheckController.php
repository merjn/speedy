<?php

declare(strict_types=1);

namespace Merjn\App\Presentation\Controller;

use Merjn\App\Presentation\Response\Handshake\EncryptionOffResponse;
use Merjn\App\Presentation\Response\Handshake\SecretKeyResponse;
use Merjn\Speedy\Communication\ServerResponse;
use Merjn\Speedy\Contracts\Communication\RequestInterface;
use Merjn\Speedy\Contracts\Communication\ServerResponseInterface;

class VersionCheckController
{
    public function __invoke(RequestInterface $request): ServerResponseInterface
    {
        return (new ServerResponse())
            ->add(new EncryptionOffResponse())
            ->add(new SecretKeyResponse("31vw2swky25q9ko940i8x068ftxrmt0wa3vgj27qtrr3m35rn067o549fl"));
    }
}