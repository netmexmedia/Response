<?php

namespace Netmex\Response\Tests;

use Netmex\Response\Strategy\RedirectResponseStrategy;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;

final class RedirectResponseStrategyTest extends TestCase
{
    public function testCreatesRedirectResponse()
    {
        $strategy = new RedirectResponseStrategy();

        $response = $strategy->create('https://example.com', 301);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(301, $response->getStatusCode());
        $this->assertEquals('https://example.com', $response->getTargetUrl());
    }
}

