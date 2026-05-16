<?php

namespace Netmex\Response\Tests\Fixtures;

use Netmex\Response\Attribute\Response as ResponseAttr;
use Netmex\Response\Strategy\JsonResponseStrategy;

#[ResponseAttr(strategy: JsonResponseStrategy::class, status: 200, collection: false)]
final class ResolverTestDto
{
    public function __construct(public mixed $payload = null) {}
}

