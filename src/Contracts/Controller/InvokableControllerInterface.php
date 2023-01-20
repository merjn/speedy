<?php

namespace Merjn\Speedy\Contracts\Controller;

interface InvokableControllerInterface
{
    public function __invoke(): void;
}