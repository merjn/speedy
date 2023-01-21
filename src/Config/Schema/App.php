<?php

namespace Merjn\Speedy\Config\Schema;

use Nette\Schema\Expect;
use Nette\Schema\Schema;

class App
{
    public static function getSchema(): Schema
    {
        return Expect::structure([
            'network' => Expect::structure([
                'server' => Expect::string()->required(),
                'port' => Expect::int()->required(),
                'workers' => Expect::int()->required(),
            ]),

            'database' => Expect::structure([
                'db_driver' => Expect::string()->required(),
                'user' => Expect::string()->required(),
                'dbname' => Expect::string()->required(),
                'password' => Expect::string()->required(),
                'dev_mode' => Expect::bool()->required(),
            ]),

            'packet' => Expect::structure([
                'logging' => Expect::structure([
                    'enabled' => Expect::bool()->required(),
                ]),
            ]),

            'providers' => Expect::arrayOf('string')->required()
        ]);
    }
}