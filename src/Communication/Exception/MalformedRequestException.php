<?php

declare(strict_types=1);

namespace Merjn\Speedy\Communication\Exception;

class MalformedRequestException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}