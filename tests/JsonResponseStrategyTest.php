<?php

namespace Netmex\Response\Tests;

use Netmex\Response\Strategy\JsonResponseStrategy;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

final class JsonResponseStrategyTest extends TestCase
{
    public function testCreatesJsonResponse()
    {
        $strategy = new JsonResponseStrategy();

        $data = ['foo' => 'bar'];
        $response = $strategy->create($data, 201);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertStringContainsString('"foo"', $response->getContent());
    }
}

