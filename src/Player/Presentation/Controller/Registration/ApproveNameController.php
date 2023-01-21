<?php

declare(strict_types=1);

namespace Merjn\Speedy\Player\Presentation\Controller\Registration;

use Merjn\Speedy\Player\Application\Registration\VerifyUsernameAction;
use Merjn\Speedy\Player\Presentation\Response\Registration\NameApproved;
use Merjn\Speedy\Player\Presentation\Response\Registration\NameUnacceptable;
use Merjn\Speedy\Player\Presentation\Traits\ExecutesInvokableActionTrait;
use Merjn\Speedy\Communication\ServerResponse;
use Merjn\Speedy\Contracts\Communication\RequestInterface;
use Merjn\Speedy\Contracts\Communication\ServerResponseInterface;

class ApproveNameController
{
    use ExecutesInvokableActionTrait;

    public function __construct(
        private readonly VerifyUsernameAction $verifyUsernameAction
    ) { }

    public function __invoke(RequestInterface $request): ServerResponseInterface
    {
        if (!$request->hasBody()) {
            return new ServerResponse();
        }

        $validName = $this->executeAction($this->verifyUsernameAction, [$request->get(0)]);

        return (new ServerResponse())->add($validName ? new NameApproved() : new NameUnacceptable());
    }
}