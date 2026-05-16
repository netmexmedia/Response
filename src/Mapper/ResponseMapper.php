<?php

declare(strict_types=1);

namespace Netmex\Response\Mapper;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final readonly class ResponseMapper
{
    public function __construct(
        private NormalizerInterface   $normalizer,
        private DenormalizerInterface $denormalizer,
    ) {}

    public function map(mixed $data, string $type, bool $isCollection): mixed
    {
        $normalized = $this->normalizer->normalize($data);

        $targetType = $isCollection ? $type . '[]' : $type;

        return $this->denormalizer->denormalize($normalized, $targetType);
    }
}
