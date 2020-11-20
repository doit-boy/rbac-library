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

use DoitBoy\RBAC\Contract\ClientInterface;
use Hyperf\Utils\Collection;

class Client implements ClientInterface
{
    protected $options;

    public function __construct(array $options)
    {
        $this->options = $options;
    }

    public function check(int $id, int $project, string $route): Auth
    {
        return new Auth($id, $project, $route, 0);
    }

    public function resources(int $id, int $project): Collection
    {
        return new Collection([]);
    }
}
