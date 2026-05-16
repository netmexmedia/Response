<?php

namespace Netmex\Response\Tests;

use Netmex\Response\Strategy\HtmlResponseStrategy;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

final class HtmlResponseStrategyTest extends TestCase
{
    public function testCreatesHtmlResponse()
    {
        $strategy = new HtmlResponseStrategy();

        $html = '<h1>Hello</h1>';
        $response = $strategy->create($html, 202);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(202, $response->getStatusCode());
        $this->assertStringContainsString('<h1>Hello</h1>', $response->getContent());
        $this->assertStringContainsString('text/html', $response->headers->get('Content-Type'));
    }
}

