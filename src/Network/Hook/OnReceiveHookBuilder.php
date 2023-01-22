<?php

declare(strict_types=1);

namespace Merjn\Speedy\Network\Hook;

use Merjn\Speedy\Contracts\Communication\RequestFactoryInterface;
use Merjn\Speedy\Contracts\Network\Session\SessionRepositoryInterface;
use Merjn\Speedy\Routing\Exceptions\UndefinedRouteException;
use Merjn\Speedy\Routing\Router;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use OpenSwoole\Server;
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
        return new Hook('receive', function (Server $server, int $fd, int $reactorId, string $data) {
//            $this->logger->info("Worker {$server->worker_id} received data from {$fd}: {$data}");
            $session = $this->sessionRepository->getById($fd);

            try {
                dump($data);
                $response = $this->router->dispatch($this->requestFactory->createRequest($session, $data));
                foreach ($response->getMessages() as $message) {
                    $server->send($fd, $message->getServerMessage());

                    $this->logger->info("Sent message {$message->getServerMessage()} to session {$session->getId()}");
                }
            } catch (UndefinedRouteException $e) {
                $this->logger->warning("[UNHANDLED PACKET] {$data}");
            }
        });
    }
}