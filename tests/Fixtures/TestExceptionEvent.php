<?php

namespace Netmex\Response\Tests\Fixtures;

use Symfony\Component\HttpFoundation\Request;

final class TestExceptionEvent
{
    private Request $request;
    private \Throwable $throwable;
    private $response;

    public function __construct(Request $request, \Throwable $throwable)
    {
        $this->request = $request;
        $this->throwable = $throwable;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function getThrowable(): \Throwable
    {
        return $this->throwable;
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

