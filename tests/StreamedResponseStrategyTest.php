<?php

namespace Netmex\Response\Tests;

use Netmex\Response\Strategy\StreamedResponseStrategy;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\StreamedResponse;

final class StreamedResponseStrategyTest extends TestCase
{
    public function testCreatesStreamedResponse()
    {
        $strategy = new StreamedResponseStrategy();

        $callback = function() { echo 'ok'; };
        $response = $strategy->create($callback, 200);

        $this->assertInstanceOf(StreamedResponse::class, $response);
    }
}

