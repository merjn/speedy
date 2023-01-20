<?php

namespace Merjn\Speedy\Network\Hook;

interface HookBuilderInterface
{
    public function __invoke(): Hook;
}