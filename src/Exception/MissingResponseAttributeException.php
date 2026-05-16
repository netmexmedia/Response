<?php

declare(strict_types=1);

namespace Netmex\Response\Exception;

final class MissingResponseAttributeException extends ResponseException
{
    public static function forClass(string $class): self
    {
        return new self(
            sprintf(
                'Missing #[Response] attribute on "%s".',
                $class
            )
        );
    }
}