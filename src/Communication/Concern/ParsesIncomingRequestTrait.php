<?php

declare(strict_types=1);

namespace Merjn\Speedy\Communication\Concern;

use Merjn\Speedy\Communication\Exception\MalformedRequestException;

trait ParsesIncomingRequestTrait
{
    /**
     * Parse the request length.
     *
     * @return void
     * @throws MalformedRequestException
     */
    protected function parseRequestLength(): void
    {
        if (is_int($position = strpos($this->packetBuffer, ' '))) {
            $this->requestLength = (int) substr($this->packetBuffer, 0, $position);
            $this->packetBuffer = substr($this->packetBuffer, $position + 1);

            return;
        }

        throw new MalformedRequestException('The request length could not be determined.');
    }

    /**
     * Parse the request header.
     *
     * @return void
     */
    protected function parseRequestHeader(): void
    {
        $this->packetBuffer = ltrim($this->packetBuffer);

        if (is_int($position = strpos($this->packetBuffer, ' '))) {
            $this->header = substr($this->packetBuffer, 0, $position);
            $this->packetBuffer = substr($this->packetBuffer, $position + 1);

            return;
        }

        $this->header = $this->packetBuffer;
        $this->packetBuffer = '';
    }

    /**
     * Parse body headers. This method will parse the body headers and store them in the body array.
     *
     * @return void
     */
    protected function parseBodyHeader(): void
    {
        $this->packetBuffer = str_replace(': ', ':', $this->packetBuffer);

        if (!str_contains($this->packetBuffer, ' ')) {
            [$key, $value] = explode(':', $this->packetBuffer);
            $this->body[$key] = $value;

            return;
        }

        foreach (explode(' ', $this->packetBuffer) as $argument) {
            [$key, $value] = explode(':', $argument);
            $this->body[$key] = $value;
        }
    }

    private function parseMap(): void
    {
        foreach (explode("\r", $this->packetBuffer) as $argument) {
            if ($argument === '') {
                continue;
            }

            // It's possible that there is only one argument. Check if the argument is empty.
            $packet = explode('=', $argument, 2);
            if (count($packet) === 1) {
                $this->body[$packet[0]] = '';
                continue;
            }

            $this->body[$packet[0]] = $packet[1];
        }
    }

    private function parseArray(): void
    {
        if (str_contains($this->packetBuffer, '/')) {
            $this->body[] = $this->packetBuffer;
        } else {
            $this->body = explode(' ', $this->packetBuffer);
        }
    }

    /**
     * Parse the request body.
     *
     * @return void
     */
    protected function parseBody(): void
    {
        if ($this->packetBuffer === '') {
            return;
        }

        // We need to remove the spaces from the left so that we can handle the packet body.
        $this->packetBuffer = ltrim($this->packetBuffer);

        match(true) {
            str_contains($this->packetBuffer, ':') => $this->parseBodyHeader(),
            str_contains($this->packetBuffer, '=') => $this->parseMap(),
            str_contains($this->packetBuffer, '/') => $this->parseArray(),
            default => $this->body = explode(' ', $this->packetBuffer)
        };

        // The packet buffer can now be emptied, since we have parsed the body.
        $this->packetBuffer = '';
    }
}