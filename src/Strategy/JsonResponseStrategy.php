<?php

declare(strict_types=1);

namespace Netmex\Response\Strategy;

use Netmex\Response\Contracts\ResponseStrategyInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class JsonResponseStrategy implements ResponseStrategyInterface
{
    public function create(mixed $data, int $status): Response
    {
        return new JsonResponse($data, $status);
    }
}
