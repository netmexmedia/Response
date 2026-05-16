<?php

declare(strict_types=1);

namespace Netmex\Response\Strategy;

use Netmex\Response\Contracts\ResponseStrategyInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

final class BinaryFileResponseStrategy implements ResponseStrategyInterface
{
    public function create(mixed $filePath, string|int $downloadName = null): BinaryFileResponse
    {
        $response = new BinaryFileResponse($filePath);

        if ($downloadName) {
            $response->setContentDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT,
                $downloadName
            );
        }

        return $response;
    }
}
