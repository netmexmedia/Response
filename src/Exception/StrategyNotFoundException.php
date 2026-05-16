<?php

declare(strict_types=1);

namespace Netmex\Response\Exception;

final class StrategyNotFoundException extends ResponseException
{
    public static function forClass(string $class): self
    {
        return new self(
            sprintf(
                'Response strategy not found: "%s". Ensure it is registered and implements ResponseStrategyInterface.',
                $class
            )
        );
    }
}