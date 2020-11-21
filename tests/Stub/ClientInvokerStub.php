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
namespace HyperfTest\Stub;

use DoitBoy\RBAC\Contract\HandlerInvokerInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Promise\FulfilledPromise;
use GuzzleHttp\Psr7;
use Hyperf\Utils\Codec\Json;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;

class ClientInvokerStub implements HandlerInvokerInterface
{
    /**
     * @var string
     */
    protected $body;

    /**
     * @var array
     */
    protected $headers;

    public function __construct(array $data = [], array $headers = [])
    {
        $this->body = Json::encode($data);
        $this->headers = $headers;
    }

    public function __invoke(ContainerInterface $container): HandlerStack
    {
        $handler = function (RequestInterface $request, array $options) {
            $response = new Psr7\Response(200, [], $this->body);
            return new FulfilledPromise($response);
        };
        // $handler = null;
        return HandlerStack::create($handler);
    }
}
