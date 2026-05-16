<?php

declare(strict_types=1);

namespace Netmex\Response\Contracts;

use Symfony\Component\HttpFoundation\Response;

interface ResponseStrategyInterface
{
    public function create(mixed $data, int $status): Response;
}
