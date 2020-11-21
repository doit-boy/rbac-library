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
use Hyperf\Contract\ConfigInterface;
use Psr\Container\ContainerInterface;

class ClientFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $options = $container->get(ConfigInterface::class)->get('rbac.options', [
            'base_uri' => 'http://rbac_api:8000',
            'handler' => new HandlerInvoker(),
            'timeout' => 2,
        ]);

        if (isset($options['handler']) && $options['handler'] instanceof HandlerInvokerInterface) {
            $options['handler'] = $options['handler']->__invoke($container);
        }

        return new Client($options);
    }
}
