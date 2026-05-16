<?php

namespace Netmex\Response\Tests;

use Netmex\Response\Strategy\BinaryFileResponseStrategy;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

final class BinaryFileResponseStrategyTest extends TestCase
{
    public function testCreatesBinaryFileResponse()
    {
        $strategy = new BinaryFileResponseStrategy();

        // create a temporary file
        $tmp = tempnam(sys_get_temp_dir(), 'resp');
        file_put_contents($tmp, 'hello');

        $response = $strategy->create($tmp, 'download.txt');

        $this->assertInstanceOf(BinaryFileResponse::class, $response);

        // cleanup
        @unlink($tmp);
    }
}

