<?php

declare(strict_types=1);

namespace Netmex\Response\Strategy;

use Netmex\Response\Contracts\ResponseStrategyInterface;
use Symfony\Component\HttpFoundation\Response;

final class HtmlResponseStrategy implements ResponseStrategyInterface
{
    public function create(mixed $html, int $status = 200): Response
    {
        return new Response($html, $status, [
            'Content-Type' => 'text/html',
        ]);
    }
}
