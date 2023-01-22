<?php

declare(strict_types=1);

namespace Merjn\Speedy\Communication;

use Merjn\Speedy\Contracts\Communication\ServerBodyInterface;

class ServerBody implements ServerBodyInterface
{
    /**
     * @var string
     */
    private string $buffer = "";

    /**
     * @var bool
     */
    private bool $finished = false;

    /**
     * Create a new server message.
     *
     * @param string $header
     */
    public function __construct(
        private string $header
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

    public function getBody(): string
    {
        if (!$this->finished) {
            $this->buffer .= "##";
            $this->finished = true;
        }

        return $this->buffer;
    }
}