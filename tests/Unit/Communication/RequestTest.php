<?php

declare(strict_types=1);

namespace Merjn\Tests\Unit\Communication;

use PHPUnit\Framework\TestCase;

final class RequestTest extends TestCase
{
    /**
     * These packets are taken from the game client.
     * @var array|string[]
     */
    private array $testPackets = [
        "22  VERSIONCHECK client002",
        "16  KEYENCRYPTED 964",
        "72  CLIENTIP MacromediaSecretIPAddressCookie: bd8e53e42066987ac95be0e2501ff8",
        "LOGIN Merijn hallo123",
        "36  UNIQUEMACHINEID #1310746447071202023",
        "REGISTER name=Merijn password=hallo123 email=sdijfio@live.nl figure=sd=001/0&hr=001/255,255,255&hd=002/255,204,153&ey=001/0&fc=001/255,204,153&bd=001/255,204,153&lh=001/255,204,153&rh=001/255,204,153&ch=001/232,177,55&ls=001/232,177,55&rs=001/232,177,55&lg=001/119,159,187&sh=001/175,220,223 directMail=1 birthday=31.01.1991 phonenumber=+44 customData=dfgsdf has_read_agreement=1 sex=Male country="
    ];

    public function testRequest(): void
    {
        // WIP
        $this->assertTrue(true);
    }
}