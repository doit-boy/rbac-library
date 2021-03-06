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
use DoitBoy\RBAC\HandlerInvoker;

return [
    'options' => [
        'base_uri' => env('RBAC_BASE_URI', 'http://rbac_api:8000'),
        'handler' => new HandlerInvoker(),
        'timeout' => 2,
    ],
];
