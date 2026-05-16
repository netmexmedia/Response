<?php

declare(strict_types=1);

namespace Netmex\Response\Contracts;

abstract class AbstractResponse
{
    protected mixed $netmex_internal_payload;

    public function __construct(mixed $payload)
    {
        $this->netmex_internal_payload = $payload;
    }

    public function netmexPayload(): mixed
    {
        return $this->netmex_internal_payload;
    }
}