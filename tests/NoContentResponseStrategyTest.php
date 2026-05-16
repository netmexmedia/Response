<?php

namespace Netmex\Response\Tests;

use Netmex\Response\Strategy\NoContentResponseStrategy;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

final class NoContentResponseStrategyTest extends TestCase
{
    public function testCreatesNoContentResponse()
    {
        $strategy = new NoContentResponseStrategy();

        $response = $strategy->create(null, 204);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(204, $response->getStatusCode());
    }
}

