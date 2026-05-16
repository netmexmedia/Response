<?php

declare(strict_types=1);

namespace Netmex\Response;

use Netmex\Response\Contracts\ResponseStrategyInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class ResponseBundle extends AbstractBundle
{
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import(__DIR__ . '/../config/services.yaml');
    }

    public function build(ContainerBuilder $container): void
    {
        $container->registerForAutoconfiguration(ResponseStrategyInterface::class)
            ->addTag('app.response_strategy');
    }

}
