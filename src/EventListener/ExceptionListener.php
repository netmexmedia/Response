<?php

namespace Netmex\Response\EventListener;

use Netmex\Response\ResponseInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

final class ExceptionListener
{
    public function onExceptionEvent(ExceptionEvent $event): void
    {
        $controller = $event->getRequest()->attributes->get('_controller');

        if (null === $controller) {
            return;
        }

        [$class, $method] = $this->resolveController($controller);

        $responseClass = $this->getReturnTypeClass($class, $method);

        if (!$responseClass->implementsInterface(ResponseInterface::class)) {
            return;
        }

        $responseInstance = $responseClass->newInstance();
        $response = $responseInstance->onError($event->getThrowable());

        $event->setResponse($response);
    }

    private function resolveController(string $controller): array
    {
        if (!str_contains($controller, '::')) {
            return [$controller, '__invoke'];
        }

        return explode('::', $controller);
    }

    public function getReturnTypeClass(string $class, string $method): ?\ReflectionClass
    {
        $reflection = new \ReflectionMethod($class, $method);
        $returnType = $reflection->getReturnType();

        $typeName = $returnType->getName();

        return new \ReflectionClass($typeName);
    }
}
