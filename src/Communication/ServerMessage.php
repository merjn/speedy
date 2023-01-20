<?php

declare(strict_types=1);

namespace Merjn\Speedy\Communication;

use Merjn\Speedy\Contracts\Communication\ServerMessageInterface;

class ServerMessage implements ServerMessageInterface
{
    /**
     * Create a new server message.
     *
     * @param string $header
     * @param string $buffer
     * @param bool $finished
     */
    public function __construct(
        private string $header,
        private string $buffer = "",
        private bool $finished = false,
    ) {
        $this->writeHeader($this->header);
    }

    /**
     * Write the header.
     *
     * @param string $header
     * @return void
     */
    private function writeHeader(string $header): void
    {
        $this->buffer .= "#";
        $this->buffer .= $header;
    }

    public function append(string $argument): void
    {
        $this->buffer .= str_replace($argument, "#", "*");
    }

    public function appendArgument(string $argument, ServerMessageDelimiter $delimiter): void
    {
        $this->buffer .= $delimiter->value;
        $this->buffer .= $argument;
    }

    public function newString(string $argument): void
    {
        $this->appendArgument($argument, ServerMessageDelimiter::CarriageReturn);
    }
}