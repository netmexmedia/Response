<?php

declare(strict_types=1);

namespace Netmex\Response\Exception;

final class InvalidResponseTypeException extends ResponseException
{
    public static function expectedObject(mixed $given): self
    {
        return new self(
            sprintf(
                'Response must be an object DTO, got "%s".',
                gettype($given)
            )
        );
    }
}