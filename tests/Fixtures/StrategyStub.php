<?php

namespace Netmex\Response\Tests\Fixtures;

use Netmex\Response\Contracts\ResponseStrategyInterface;
use Symfony\Component\HttpFoundation\Response;

final class StrategyStub implements ResponseStrategyInterface
{
    private Response $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function create(mixed $data, int $status): Response
    {
        return $this->response;
    }
}

