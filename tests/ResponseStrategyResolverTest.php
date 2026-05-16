<?php

namespace Netmex\Response\Tests;

use Netmex\Response\Resolver\ResponseStrategyResolver;
use Netmex\Response\Strategy\JsonResponseStrategy;
use Netmex\Response\Contracts\ResponseStrategyInterface;
use Netmex\Response\Exception\StrategyNotFoundException;
use PHPUnit\Framework\TestCase;

final class ResponseStrategyResolverTest extends TestCase
{
    public function testReturnsDefaultWhenNull()
    {
        $default = new JsonResponseStrategy();
        $resolver = new ResponseStrategyResolver([], $default);

        $this->assertSame($default, $resolver->resolve(null));
    }

    public function testResolvesByClassName()
    {
        $json = new JsonResponseStrategy();
        $default = new JsonResponseStrategy();
        $resolver = new ResponseStrategyResolver([$json], $default);

        $resolved = $resolver->resolve(JsonResponseStrategy::class);

        $this->assertSame($json, $resolved);
    }

    public function testThrowsWhenNotFound()
    {
        $this->expectException(StrategyNotFoundException::class);

        $resolver = new ResponseStrategyResolver([], new JsonResponseStrategy());

        $resolver->resolve('NonExistentStrategy');
    }
}

