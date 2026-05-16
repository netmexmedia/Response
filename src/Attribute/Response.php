<?php

declare(strict_types=1);

namespace Netmex\Response\Attribute;

#[\Attribute(\Attribute::TARGET_CLASS)]
class Response
{
    public function __construct(
        public ?string $strategy = null,
        public int $status = 200,
        public bool $collection = false,
    ) {}
}
