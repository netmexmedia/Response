<?php

namespace Netmex\Response\Tests;

use Netmex\Response\Strategy\TextResponseStrategy;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

final class TextResponseStrategyTest extends TestCase
{
    public function testCreatesTextResponse()
    {
        $strategy = new TextResponseStrategy();

        $response = $strategy->create('plain text', 200);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('text/plain', $response->headers->get('Content-Type'));
    }
}

