<?php

namespace Netmex\Response\Tests;

use Netmex\Response\EventListener\ResponseListener;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;

final class ResponseListenerTest extends TestCase
{
    private function listenerWithoutResolver(): ResponseListener
    {
        $ref = new \ReflectionClass(ResponseListener::class);
        return $ref->newInstanceWithoutConstructor();
    }

    private function makeViewEvent(mixed $controllerResult): ViewEvent
    {
        $kernel = new class implements HttpKernelInterface {
            public function handle(Request $request, int $type = self::MAIN_REQUEST, bool $catch = true): Response
            {
                return new Response();
            }
        };

        $request = new Request();

        return new ViewEvent($kernel, $request, HttpKernelInterface::MAIN_REQUEST, $controllerResult);
    }

    public function testIgnoresHttpFoundationResponse()
    {
        $listener = $this->listenerWithoutResolver();

        $event = $this->makeViewEvent(new Response());

        // Should not throw
        $listener->onKernelView($event);

        $this->addToAssertionCount(1);
    }

    public function testThrowsOnNonObject()
    {
        $this->expectException(\Netmex\Response\Exception\InvalidResponseTypeException::class);

        $listener = $this->listenerWithoutResolver();

        $event = $this->makeViewEvent('not-an-object');

        $listener->onKernelView($event);
    }
}
