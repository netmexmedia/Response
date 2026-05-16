<?php

declare(strict_types=1);

namespace Netmex\Response\Strategy;

use Netmex\Response\Contracts\ResponseStrategyInterface;
use Symfony\Component\HttpFoundation\Response;

final class TextResponseStrategy implements ResponseStrategyInterface
{
    public function create(mixed $text, int $status = 200): Response
    {
        return new Response($text, $status, [
            'Content-Type' => 'text/plain',
        ]);
    }
}
