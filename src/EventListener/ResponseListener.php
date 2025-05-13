<?php

namespace Netmex\Response\EventListener;

use Netmex\Response\ResponseInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;

final class ResponseListener
{
    public function onKernelView(ViewEvent $event): void
    {
        $controllerResult = $event->getControllerResult();

        if ($controllerResult instanceof ResponseInterface) {
            $response = $controllerResult->toResponse($event->getRequest());
            $event->setResponse($response);
        }
    }
}
