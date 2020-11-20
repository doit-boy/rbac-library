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

use Hyperf\Utils\Contracts\Arrayable;

class RouteResource implements Arrayable
{
    public function toArray(): array
    {
        return [];
    }
}
