<?php

declare(strict_types=1);

namespace Netmex\Response\EventListener;

use Netmex\Response\Contracts\AbstractResponse;
use Netmex\Response\Exception\InvalidResponseTypeException;
use Netmex\Response\Resolver\ResponseResolver;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ViewEvent;

final readonly class ResponseListener
{
    public function __construct(
        private ResponseResolver $resolver,
    ) {}

    public function onKernelView(ViewEvent $event): void
    {
        $result = $event->getControllerResult();

        if ($result instanceof Response) {
            return;
        }

        if (!is_object($result)) {
            throw InvalidResponseTypeException::expectedObject($result);
        }

        $payload = $this->extractPayload($result);

        $event->setResponse(
            $this->resolver->resolve($result, $payload)
        );
    }

    private function extractPayload(object $result): mixed
    {
        if ($result instanceof AbstractResponse) {
            return $result->netmexPayload();
        }

        return null;
    }
}