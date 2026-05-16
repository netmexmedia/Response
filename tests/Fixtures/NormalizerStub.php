<?php

namespace Netmex\Response\Tests\Fixtures;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class NormalizerStub implements NormalizerInterface
{
    public function normalize($object, $format = null, array $context = []) { return $object; }
    public function supportsNormalization($data, $format = null) { return true; }
}

