<?php

declare(strict_types=1);

namespace Merjn\Speedy\Network\Hook;

use Merjn\Speedy\Contracts\Communication\RequestFactoryInterface;
use Merjn\Speedy\Contracts\Network\Session\SessionRepositoryInterface;
use Merjn\Speedy\Routing\Exceptions\UndefinedRouteException;
use Merjn\Speedy\Routing\Router;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

class OnReceiveHookBuilder implements HookBuilderInterface
{
    public function __construct(
        private readonly RequestFactoryInterface $requestFactory,
        private readonly SessionRepositoryInterface $sessionRepository,
        private readonly Router $router,
        private readonly LoggerInterface $logger = new Logger(OnReceiveHookBuilder::class, [new StreamHandler('php://stdout')]),
    ) { }

    public function __invoke(): Hook
    {
        return new Hook('receive', function ($server, $fd, $reactorId, $data) {
            $session = $this->sessionRepository->getById($fd);

            try {
                $response = $this->router->dispatch($this->requestFactory->createRequest($session, $data));

                $this->logger->info("[HANDLED] Packet received from {$fd}: {$data}");

                foreach ($response as $packet) {
                    $server->send($fd, $packet);
                    $this->logger->info("[SENT] Packet sent to {$fd}: {$packet}");
                }
            } catch (UndefinedRouteException $e) {
                $this->logger->warning("[UNHANDLED PACKET] {$data}");
            }
        });
    }
}