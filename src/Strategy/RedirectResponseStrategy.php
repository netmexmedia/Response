<?php

declare(strict_types=1);

namespace Netmex\Response\Strategy;

use Netmex\Response\Contracts\ResponseStrategyInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

final class RedirectResponseStrategy implements ResponseStrategyInterface
{
    public function create(mixed $url, int $status = 302): Response
    {
        return new RedirectResponse($url, $status);
    }
}
