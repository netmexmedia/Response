<?php

namespace Netmex\Response\Tests;

use PHPUnit\Framework\TestCase;

final class ResponseResolverIntegrationTest extends TestCase
{
    public function testEndToEndJsonResponse()
    {
        $this->markTestSkipped('End-to-end resolver integration is skipped in this environment; re-enable in CI or local debug run.');
    }
}
