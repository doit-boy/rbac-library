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
use GuzzleHttp\Utils;
use Psr\Container\ContainerInterface;

class HandlerInvoker implements HandlerInvokerInterface
{
    public function __invoke(ContainerInterface $container): HandlerStack
    {
        return Utils::chooseHandler();
    }
}
