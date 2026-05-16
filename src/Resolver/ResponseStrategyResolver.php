<?php

declare(strict_types=1);

namespace Netmex\Response\Resolver;

use Netmex\Response\Contracts\ResponseStrategyInterface;
use Netmex\Response\Exception\StrategyNotFoundException;

final readonly class ResponseStrategyResolver
{
    /** @param iterable<ResponseStrategyInterface> $strategies */
    public function __construct(
        private iterable $strategies,
        private ResponseStrategyInterface $defaultStrategy,
    ) {}

    public function resolve(?string $strategyClass): ResponseStrategyInterface
    {
        if ($strategyClass === null) {
            return $this->defaultStrategy;
        }

        foreach ($this->strategies as $strategy) {
            if ($strategy::class === $strategyClass) {
                return $strategy;
            }
        }

        if (class_exists($strategyClass)) {
            foreach ($this->strategies as $strategy) {
                if ($strategy instanceof $strategyClass) {
                    return $strategy;
                }
            }
        }

        throw StrategyNotFoundException::forClass($strategyClass);
    }
}