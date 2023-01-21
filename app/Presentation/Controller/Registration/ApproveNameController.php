<?php

declare(strict_types=1);

namespace Merjn\App\Presentation\Controller\Registration;

use Merjn\App\Application\Registration\VerifyUsernameAction;
use Merjn\App\Presentation\Response\Registration\NameApproved;
use Merjn\App\Presentation\Response\Registration\NameUnacceptable;
use Merjn\App\Presentation\Traits\ExecutesInvokableActionTrait;
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