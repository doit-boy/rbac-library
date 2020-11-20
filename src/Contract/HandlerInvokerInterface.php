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
namespace DoitBoy\RBAC\Contract;

use GuzzleHttp\HandlerStack;
use Psr\Container\ContainerInterface;

interface HandlerInvokerInterface
{
    public function __invoke(ContainerInterface $container): HandlerStack;
}
