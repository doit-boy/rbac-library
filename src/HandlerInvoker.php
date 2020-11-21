<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace DoitBoy\RBAC;

use DoitBoy\RBAC\Contract\HandlerInvokerInterface;
use GuzzleHttp\HandlerStack;
use Hyperf\Guzzle\HandlerStackFactory;
use Psr\Container\ContainerInterface;
use function GuzzleHttp\choose_handler;

class HandlerInvoker implements HandlerInvokerInterface
{
    public function __invoke(ContainerInterface $container): HandlerStack
    {
        if ($container->has(HandlerStackFactory::class) && $factory = $container->get(HandlerStackFactory::class)) {
            return $factory->create();
        }

        return choose_handler();
    }
}
