<?php

namespace Netmex\Response\Tests;

use Netmex\Response\Metadata\ResponseMetadataResolver;
use Netmex\Response\Attribute\Response as ResponseAttr;
use Netmex\Response\Contracts\AbstractResponse;
use Netmex\Response\Exception\MissingResponseAttributeException;
use Netmex\Response\Strategy\JsonResponseStrategy;
use PHPUnit\Framework\TestCase;

#[ResponseAttr(strategy: JsonResponseStrategy::class, status: 201, collection: false)]
class MetaDto extends AbstractResponse
{
    public function __construct(mixed $payload = null) { parent::__construct($payload); }
}

final class ResponseMetadataResolverTest extends TestCase
{
    public function testResolvesMetadataFromAttribute()
    {
        $resolver = new ResponseMetadataResolver();

        $dto = new MetaDto(['x' => 'y']);

        $meta = $resolver->resolve($dto);

        $this->assertEquals(JsonResponseStrategy::class, $meta->strategy);
        $this->assertEquals(201, $meta->status);
        $this->assertFalse($meta->collection);
    }

    public function testThrowsWhenAttributeMissing()
    {
        $this->expectException(MissingResponseAttributeException::class);

        $resolver = new ResponseMetadataResolver();

        $dto = new class extends AbstractResponse { public function __construct() { parent::__construct(null); } };

        $resolver->resolve($dto);
    }
}

