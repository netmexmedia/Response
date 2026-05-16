<?php

declare(strict_types=1);

namespace Netmex\Response\Resolver;

final readonly class ResponseConfig
{
    public function __construct(
        public string $type,
        public bool   $isCollection,
        public int    $status,
    ) {}
}
