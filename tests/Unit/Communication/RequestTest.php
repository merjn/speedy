<?php

declare(strict_types=1);

namespace Merjn\Tests\Unit\Communication;

use Merjn\Speedy\Communication\Request;
use Merjn\Speedy\Contracts\Network\Session\SessionInterface;
use Mockery;
use PHPUnit\Framework\TestCase;

final class RequestTest extends TestCase
{
    /**
     * The key is the unprocessed packet from the client and the value is how it should be processed by the Request class.
     *
     * @var array<string, array>
     */
    private array $testPackets = [
        "22  VERSIONCHECK client002" => [
            'length' => 22,
            'header' => 'VERSIONCHECK',
            'body' => [
                'client002',
            ],
        ],
        "16  KEYENCRYPTED 964" => [
            'length' => 16,
            'header' => 'KEYENCRYPTED',
            'body' => [
                '964'
            ],
        ],

        "72  CLIENTIP MacromediaSecretIPAddressCookie: bd8e53e42066987ac95be0e2501ff8" => [
            'length' => 72,
            'header' => 'CLIENTIP',
            'body' => [
                'MacromediaSecretIPAddressCookie' => 'bd8e53e42066987ac95be0e2501ff8',
            ],
        ],

        '18  MULTIPLE A: b C: d' => [
            'length' => 18,
            'header' => 'MULTIPLE',
            'body' => [
                'A' => 'b',
                'C' => 'd',
            ],
        ],

        '27  STAT /ShockwaveVersion/10.4' => [
            'length' => 27,
            'header' => 'STAT',
            'body' => ['/ShockwaveVersion/10.4'],
        ],

        '13  MESSENGERINIT' => [
            'length' => 13,
            'header' => 'MESSENGERINIT',
            'body' => [],
        ],

        "20  LOGIN Merjn hallo123" => [
            'length' => 20,
            'header' => 'LOGIN',
            'body' => [
                'Merjn', 'hallo123'
            ]
        ],

        "36  UNIQUEMACHINEID #1310746447071202023" => [
            'length' => 36,
            'header' => 'UNIQUEMACHINEID',
            'body' => [
                '#1310746447071202023',
            ],
        ],

        "391 REGISTER name=hoi\rpassword=hoi123\remail=d@live.nl\rfigure=sd=001/0&hr=001/255,255,255&hd=002/255,204,153&ey=001/0&fc=001/255,204,153&bd=001/255,204,153&lh=001/255,204,153&rh=001/255,204,153&ch=001/232,177,55&ls=001/232,177,55&rs=001/232,177,55&lg=001/119,159,187&sh=001/175,220,223\rdirectMail=1\rbirthday=31.01.1991\rphonenumber=+44\rcustomData=ha ha ha =\rhas_read_agreement=1\rsex=Male\rcountry=\r" => [
            'length' => 391,
            'header' => 'REGISTER',
            'body' => [
                'name' => 'hoi',
                'password' => 'hoi123',
                'email' => 'd@live.nl',
                'figure' => 'sd=001/0&hr=001/255,255,255&hd=002/255,204,153&ey=001/0&fc=001/255,204,153&bd=001/255,204,153&lh=001/255,204,153&rh=001/255,204,153&ch=001/232,177,55&ls=001/232,177,55&rs=001/232,177,55&lg=001/119,159,187&sh=001/175,220,223',
                'directMail' => '1',
                'birthday' => '31.01.1991',
                'phonenumber' => '+44',
                'customData' => 'ha ha ha =',
                'has_read_agreement' => '1',
                'sex' => 'Male',
                'country' => '',
            ],
        ],

        '27  INFORETRIEVE Merjn hallo123' => [
            'length' => 27,
            'header' => 'INFORETRIEVE',
            'body' => [
                'Merjn', 'hallo123'
            ],
        ],

        '32  UINFO_MATCH /looking for a habbo' => [
            'length' => 32,
            'header' => 'UINFO_MATCH',
            'body' => [
                '/looking for a habbo',
            ]
        ]
    ];

    public function testRequest(): void
    {
        // We won't need a session for this request, since we're not testing the session.
        $session = Mockery::mock(SessionInterface::class);

        // Loop through all the test packets, so that we can test them all.
        foreach ($this->testPackets as $packet => $expected) {
            $request = new Request($session, $packet);

            $this->assertEquals($expected['length'], $request->getRequestLength(), "Expected length {$expected['length']} for header {$expected['header']}, got {$request->getRequestLength()} instead");
            $this->assertEquals($expected['header'], $request->getPacketHeader(), "Expected header {$expected['header']} does not match {$request->getPacketHeader()}");

            $this->assertEqualsCanonicalizing($expected['body'], $request->getBody());
        }
    }
}