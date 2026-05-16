<?php

namespace Netmex\Response\Tests\Fixtures;

final class TestViewEvent
{
    private mixed $controllerResult;
    private $response;

    public function __construct(mixed $controllerResult)
    {
        $this->controllerResult = $controllerResult;
    }

    public function getControllerResult(): mixed
    {
        return $this->controllerResult;
    }

    public function setResponse($response): void
    {
        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }
}

