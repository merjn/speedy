<?php

namespace Merjn\Speedy\Config\Schema;

use Nette\Schema\Expect;
use Nette\Schema\Schema;

class Session
{
    public static function getSchema(): Schema
    {
        return Expect::structure([
            'driver' => Expect::string()->required(),
        ]);
    }
}