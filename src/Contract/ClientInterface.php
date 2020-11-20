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
use DoitBoy\RBAC\Resource;

interface ClientInterface
{
    public function check(int $id, int $project, string $route): Auth;

    /**
     * @return resource[]
     */
    public function resources(int $id, int $project): array;
}
