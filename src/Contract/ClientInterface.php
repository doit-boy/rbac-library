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

use DoitBoy\RBAC\Auth;
use DoitBoy\RBAC\RouteResource;

interface ClientInterface
{
    /**
     * 判断 管理员 对于某项目的路由是否有权限.
     */
    public function check(int $id, int $project, string $route): Auth;

    /**
     * 返回 管理员 某项目所有的资源配置.
     * @return RouteResource[]
     */
    public function resources(int $id, int $project): array;
}
