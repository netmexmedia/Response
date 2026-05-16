<?php

namespace Netmex\Response\Tests\Fixtures;

use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class DenormalizerStub implements DenormalizerInterface
{
    public function denormalize($data, $type, $format = null, array $context = []) { return ['mapped' => $data]; }
    public function supportsDenormalization($data, $type, $format = null) { return true; }
}

