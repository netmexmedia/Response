<?php

namespace Netmex\Response\Tests\Fixtures;

use Netmex\Response\ResponseInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class DummyResponse implements ResponseInterface
{
    public function toResponse(Request $request): Response { return new Response('ok'); }
    public function onError(\Throwable $error): Response { return new Response('error', 500); }
}

