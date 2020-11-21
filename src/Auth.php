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

use DoitBoy\RBAC\Contract\AuthInterface;

class Auth implements AuthInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $project;

    /**
     * @var string
     */
    protected $route;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var int
     */
    protected $result;

    /**
     * @var string
     */
    protected $message;

    public function __construct(int $id, int $project, string $route, string $method, int $result = 0, string $message = '')
    {
        $this->id = $id;
        $this->project = $project;
        $this->route = $route;
        $this->method = $method;
        $this->result = $result;
        $this->message = $message;
    }

    public function isSuccess(): bool
    {
        return $this->result === static::SUCCESS;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getProject(): int
    {
        return $this->project;
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function getResult(): int
    {
        return $this->result;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return $this
     */
    public function setResult(int $result)
    {
        $this->result = $result;
        return $this;
    }

    /**
     * @return $this
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
        return $this;
    }
}
