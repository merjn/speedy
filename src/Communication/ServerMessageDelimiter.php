<?php

declare(strict_types=1);

namespace Merjn\Speedy\Communication;

enum ServerMessageDelimiter: string
{
    case Tab = "\t";
    case Part = "/";
    case CarriageReturn = "\r";
    case Space = " ";
}