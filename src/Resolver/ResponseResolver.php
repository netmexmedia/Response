<?php

declare(strict_types=1);

namespace Netmex\Response\Resolver;

use Netmex\Response\Mapper\ResponseMapper;
use Netmex\Response\Metadata\ResponseMetadataResolver;
use Symfony\Component\HttpFoundation\Response;

final readonly class ResponseResolver
{
    public function __construct(
        private ResponseMetadataResolver $metadataResolver,
        private ResponseStrategyResolver $strategyResolver,
        private ResponseMapper           $mapper,
    ) {}

    public function resolve(object $dto, mixed $data): Response
    {
        $meta = $this->metadataResolver->resolve($dto);

        $strategy = $this->strategyResolver->resolve($meta->strategy);

        $mapped = $this->mapper->map(
            $data,
            $dto::class,
            $meta->collection
        );

        return $strategy->create($mapped, $meta->status);
    }
}
