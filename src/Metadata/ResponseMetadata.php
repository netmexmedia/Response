<?php

declare(strict_types=1);

namespace Netmex\Response\Metadata;

final readonly class ResponseMetadata
{
    public function __construct(
        public ?string $strategy,
        public int     $status,
        public bool    $collection,
    ) {}
}
