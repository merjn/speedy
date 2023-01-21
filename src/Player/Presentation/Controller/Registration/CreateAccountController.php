<?php

declare(strict_types=1);

namespace Merjn\Speedy\Player\Presentation\Controller\Registration;

use Merjn\Speedy\Communication\ServerResponse;
use Merjn\Speedy\Contracts\Communication\RequestInterface;
use Merjn\Speedy\Contracts\Communication\ServerResponseInterface;
use Merjn\Speedy\Player\Application\Registration\CreateUserAction;
use Merjn\Speedy\Player\Application\Registration\CreateUserDto;
use Merjn\Speedy\Player\Presentation\Traits\ExecutesInvokableActionTrait;

class CreateAccountController
{
    use ExecutesInvokableActionTrait;

    public function __construct(
        private readonly CreateUserAction $createUserAction
    ) { }

    public function __invoke(RequestInterface $request): ServerResponseInterface
    {
        /*/*[04/02/2017 00:15:13] [ROSEAU] >> [1924177861] Received: REGISTER / name=ssws
password=123
email=wdwddw@Cc.com
figure=sd=001/0&hr=001/255,255,255&hd=002/255,204,153&ey=001/0&fc=001/255,204,153&bd=001/255,204,153&lh=001/255,204,153&rh=001/255,204,153&ch=001/232,177,55&ls=001/232,177,55&rs=001/232,177,55&lg=001/119,159,187&sh=001/175,220,223
directMail=0
birthday=08.08.1997
phonenumber=+44
customData=dwdwd
has_read_agreement=1
sex=Male
country=*/

        $dto = new CreateUserDto(
            username: $request->getKvString(0),
            password: $request->getKvString(1),
            email: $request->getKvString(2),
            figure: $request->getKvString(7),
            mail: $request->getKvString(4),
            birthday: $request->getKvString(5),
            sex: $request->getKvString(9),
            country: $request->getKvString(10),
        );

        $this->executeAction($this->createUserAction, [$dto]);

        return new ServerResponse();
    }
}