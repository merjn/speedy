<?php

declare(strict_types=1);

use League\Config\Configuration;
use Merjn\Speedy\AppKernel;
use Merjn\Speedy\Config\Schema\App;
use Merjn\Speedy\Config\Schema\Session;
use OpenSwoole\Coroutine;

require_once __DIR__ . '/vendor/autoload.php';

Coroutine::set([
    'hook_flags' => \OpenSwoole\Runtime::HOOK_TCP,
]);

$container = new League\Container\Container();
$configuration = new Configuration();

$configuration->addSchema('app', App::getSchema());
$configuration->addSchema('session', Session::getSchema());

$configuration->merge(require __DIR__ . '/config/app.php');
$configuration->merge(require __DIR__ . '/config/session.php');

$container->add(Configuration::class, $configuration);

// Instantiate the application kernel. This will bootstrap the application.
(new AppKernel($container, $configuration))->boot();