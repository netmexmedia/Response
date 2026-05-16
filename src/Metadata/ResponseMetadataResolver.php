<?php

declare(strict_types=1);

namespace Netmex\Response\Metadata;

use Netmex\Response\Attribute\Response;
use Netmex\Response\Exception\MissingResponseAttributeException;

final class ResponseMetadataResolver
{
    private array $cache = [];

    public function resolve(object $dto): ResponseMetadata
    {
        $class = $dto::class;

        if (isset($this->cache[$class])) {
            return $this->cache[$class];
        }

        $reflection = new \ReflectionClass($dto);

        $attribute = $reflection->getAttributes(Response::class)[0] ?? null;

        if (!$attribute) {
            throw MissingResponseAttributeException::forClass($class);
        }

        $config = $attribute->newInstance();

        return $this->cache[$class] = new ResponseMetadata(
            strategy: $config->strategy,
            status: $config->status ?? 200,
            collection: $config->collection ?? false,
        );
    }
}