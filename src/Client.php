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
use GuzzleHttp;
use Hyperf\Utils\Codec\Json;
use Hyperf\Utils\Collection;

class Client implements ClientInterface
{
    protected $options;

    public function __construct(array $options)
    {
        $this->options = $options;
    }

    public function check(int $id, int $project, string $route, string $method): Auth
    {
        $auth = new Auth($id, $project, $route, $method);
        try {
            $response = $this->client()->post('/check', [
                GuzzleHttp\RequestOptions::JSON => [
                    'id' => $id,
                    'project' => $project,
                    'route' => $route,
                    'method' => $method,
                ],
            ]);
            $data = Json::decode((string) $response->getBody());
            $code = $data['code'];
            $isSuccess = $data['data'] ?? false;
            $message = $data['message'] ?? '';
            if ($code === static::OK && $isSuccess === false) {
                return $auth->setResult(Auth::FORBIDDEN);
            }

            if ($code !== static::OK) {
                return $auth->setResult(Auth::FAILED)->setMessage($message);
            }
        } catch (\Throwable $exception) {
            return $auth->setResult(Auth::FAILED)->setMessage($exception->getMessage());
        }

        return $auth;
    }

    public function resources(int $id, int $project): Collection
    {
        return new Collection([]);
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    protected function client()
    {
        return new GuzzleHttp\Client($this->options);
    }
}
