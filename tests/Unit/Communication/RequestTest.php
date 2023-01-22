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
     * These packets are taken from the game client.
     * @var array|string[]
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

        '27  STAT /ShockwaveVersion/10.4' => [
            'length' => 27,
            'header' => 'STAT',
            'body' => '/ShockwaveVersion/10.4',
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
                'Merijn', 'hallo123'
            ]
        ],

        "36  UNIQUEMACHINEID #1310746447071202023" => [
            'length' => 36,
            'header' => 'UNIQUEMACHINEID',
            'body' => [
                '#1310746447071202023',
            ],
        ],

        "396 REGISTER name=Merjn password=hallo123 email=sdjfjoi@live.nl figure=sd=001/0&hr=004/115,99,70&hd=002/255,204,153&ey=003/0&fc=001/255,204,153&bd=001/255,204,153&lh=001/255,204,153&rh=001/255,204,153&ch=003/232,177,55&ls=001/232,177,55&rs=001/232,177,55&lg=004/102,102,102&sh=003/121,94,83 directMail=0 birthday=31.01.1991 phonenumber=+44 customData=beep boop has_read_agreement=1 sex=Male country=" => [
            'length' => 396,
            'header' => 'REGISTER',
            'body' => [
                'name' => 'Merjn',
                'password' => 'hallo123',
                'figure' => 'sd=001/0&hr=004/115,99,70&hd=002/255,204,153&ey=003/0&fc=001/255,204,153&bd=001/255,204,153&lh=001/255,204,153&rh=001/255,204,153&ch=003/232,177,55&ls=001/232,177,55&rs=001/232,177,55&lg=004/102,102,102&sh=003/121,94,83',
                'directMail' => '0',
                'birthday' => '31.01.1991',
                'phonenumber' => '+44',
                'customData' => 'beep boop',
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

            $this->assertEquals($expected['length'], $request->getBodyLength(), "Expected length {$expected['length']} for header {$expected['header']}, got {$request->getBodyLength()} instead");
            $this->assertEquals($expected['header'], $request->getPacketHeader(), "Expected header {$expected['header']} does not match {$request->getPacketHeader()}");

            $this->assertEquals($expected['body'], $request->getBody());
        }
    }
}