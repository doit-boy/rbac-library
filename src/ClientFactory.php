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

use Hyperf\Contract\ConfigInterface;
use Hyperf\Contract\ContainerInterface;

class ClientFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $options = $container->get(ConfigInterface::class)->get('rbac.options', [
            'base_uri' => 'http://rbac_api:8000',
            'timeout' => 2,
        ]);
    }
}
