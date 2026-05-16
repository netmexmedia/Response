<?php

namespace Netmex\Response\Tests;

use Netmex\Response\Mapper\ResponseMapper;
use Netmex\Response\Tests\Fixtures\NormalizerStub;
use Netmex\Response\Tests\Fixtures\DenormalizerStub;
use PHPUnit\Framework\TestCase;

final class ResponseMapperTest extends TestCase
{
    public function testMapIsCallable()
    {
        $normalizer = new NormalizerStub();
        $denormalizer = new DenormalizerStub();

        $mapper = new ResponseMapper($normalizer, $denormalizer);

        $result = $mapper->map(['a' => 'b'], 'SomeClass', true);

        $this->assertEquals(['mapped' => ['a' => 'b']], $result);
    }
}
