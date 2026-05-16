<?php

declare(strict_types=1);

namespace Netmex\Response\Strategy;

use Netmex\Response\Contracts\ResponseStrategyInterface;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\Response;
final class StreamedResponseStrategy implements ResponseStrategyInterface
{
    public function create(mixed $callback, int $status = 200): Response
    {
        return new StreamedResponse($callback, $status);
    }
}
