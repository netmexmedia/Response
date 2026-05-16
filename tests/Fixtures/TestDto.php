<?php

namespace Netmex\Response\Tests\Fixtures;

use Netmex\Response\Attribute\Response as ResponseAttr;
use Netmex\Response\Contracts\AbstractResponse;
use Netmex\Response\Strategy\JsonResponseStrategy;

#[ResponseAttr(strategy: JsonResponseStrategy::class, status: 200, collection: false)]
final class TestDto extends AbstractResponse
{
    public function __construct(mixed $payload) { parent::__construct($payload); }
}

