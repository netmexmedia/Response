<?php

namespace Netmex\Response;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

interface ResponseInterface
{
    public function toResponse(Request $request): Response;

    public function onError(HttpException $error): Response;
}
