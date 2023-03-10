<?php

declare(strict_types=1);

namespace Merjn\Speedy\Player\Presentation\Controller;

use Merjn\Speedy\Player\Presentation\Response\Handshake\EncryptionOffResponse;
use Merjn\Speedy\Player\Presentation\Response\Handshake\SecretKeyBody;
use Merjn\Speedy\Communication\ServerResponse;
use Merjn\Speedy\Contracts\Communication\RequestInterface;
use Merjn\Speedy\Contracts\Communication\ServerResponseInterface;

class VersionCheckController
{
    public function __invoke(RequestInterface $request): ServerResponseInterface
    {
        return (new ServerResponse())
            ->add(new EncryptionOffResponse())
            ->add(new SecretKeyBody("31vw2swky25q9ko940i8x068ftxrmt0wa3vgj27qtrr3m35rn067o549fl"));
    }
}