<?php

declare(strict_types=1);

namespace Merjn\Speedy\Communication;

use Merjn\Speedy\Contracts\Communication\RequestInterface;
use Merjn\Speedy\Contracts\Network\Session\SessionInterface;

/**
 * Class Request reads the request from the client. Normally, you'd see stuff like readString(), readInt() in
 * controllers, but because Request reads the packet a priori, the packet will always remain in the same state once it
 * is instantiated. This means that you can read the packet in any order you want, and you can read it multiple times.
 * This is useful for example when you want to read the packet in a middleware, and then again in a controller.
 *
 * @package Merjn\Speedy\Communication
 */
class Request implements RequestInterface
{
    /**
     * @var int contains the packet length.
     */
    private int $requestLength;

    /**
     * @var string contains the packet header.
     */
    private string $header;

    /**
     * @var array contains the arguments.
     */
    private array $body = [];

    /**
     * Create a new request instance.
     *
     * @param SessionInterface $session
     * @param string $packetBuffer
     */
    public function __construct(
        private readonly SessionInterface $session,
        private string $packetBuffer
    ){
        $this->determineRequestLength();
        $this->determineHeader();
        $this->determineBody();
    }

    /**
     * Determine the length of the request.
     *
     * @return void
     */
    private function determineRequestLength(): void
    {
        $this->requestLength = (int)substr($this->packetBuffer, 0, 4);
        $this->packetBuffer = substr($this->packetBuffer, 4);
    }

    /**
     * Determine the packet header.
     *
     * @return void
     */
    private function determineHeader(): void
    {
        if (!str_contains($this->packetBuffer, " ")) {
            $this->header = $this->packetBuffer;
            $this->packetBuffer = ""; // done
        } else {
            $this->header = substr($this->packetBuffer, 0, strpos($this->packetBuffer, " "));
            $this->packetBuffer = substr($this->packetBuffer, strpos($this->packetBuffer, " ") + 1);
        }
    }

    private function determineBody(): void
    {
        // Add the packet buffer to the body if it contains no spaces.
        if (!str_contains($this->packetBuffer, " ")) {
            $this->body[] = $this->packetBuffer;
            $this->packetBuffer = "";

            return;
        }

        $arguments = explode(" ", $this->packetBuffer);
        dd($arguments);
        foreach ($arguments as $argument) {
            // Check if the argument contains a :
            if (str_contains($argument, ":")) {
                // Get next argument and append it to the current argument
                $argument .= " " . array_shift($arguments);
                dd($argument);
            } else {
                $this->body[] = $argument;
            }
        }
    }

    public function getPacketHeader(): string
    {
        return $this->header;
    }

    /**
     * Get the session.
     *
     * @return SessionInterface
     */
    public function getSession(): SessionInterface
    {
        return $this->session;
    }

    public function hasBody(): bool
    {
        return strlen($this->packetBuffer) > 0;
    }

    public function getLength(): int
    {
        return count(explode(ServerMessageDelimiter::Space->value, $this->packetBuffer));
    }

    public function get(int $index, ServerMessageDelimiter $delimiter = ServerMessageDelimiter::Space): string
    {
        $messages = explode($delimiter->value, $this->packetBuffer);

        if (!isset($messages[$index])) {
            throw new \OutOfBoundsException("The message index {$index} does not exist.");
        }

        return $messages[$index];
    }

    public function getKvString(int $index, ServerMessageDelimiter $delimiter = ServerMessageDelimiter::CarriageReturn): string
    {
        $message = $this->get($index, $delimiter);

        if (!str_contains($message, "=")) {
            throw new \InvalidArgumentException("The message does not contain a key-value pair.");
        }

        return explode("=", $message)[1];
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function getBodyLength(): int
    {
        return $this->requestLength;
    }
}