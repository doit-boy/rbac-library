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
namespace HyperfTest\Cases;

use DoitBoy\RBAC\Auth;
use DoitBoy\RBAC\Client;
use HyperfTest\Stub\ClientInvokerStub;
use Mockery;
use Psr\Container\ContainerInterface;

/**
 * @internal
 * @coversNothing
 */
class ClientTest extends AbstractTestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testAuthCheck()
    {
        $container = Mockery::mock(ContainerInterface::class);
        $client = new Client([
            'base_uri' => 'http://127.0.0.1:8000',
            'timeout' => 2,
            'handler' => (new ClientInvokerStub(['code' => 0, 'data' => true]))($container),
        ]);

        $auth = $client->check(1, 1, '/', 'GET');
        $this->assertSame(Auth::SUCCESS, $auth->getResult());
        $this->assertTrue($auth->isSuccess());
    }

    public function testAuthCheckForbidden()
    {
        $container = Mockery::mock(ContainerInterface::class);
        $client = new Client([
            'base_uri' => 'http://127.0.0.1:8000',
            'timeout' => 2,
            'handler' => (new ClientInvokerStub(['code' => 0, 'data' => false]))($container),
        ]);

        $auth = $client->check(1, 1, '/', 'GET');
        $this->assertSame(Auth::FORBIDDEN, $auth->getResult());
        $this->assertFalse($auth->isSuccess());
    }

    public function testAuthCheckFailed()
    {
        $container = Mockery::mock(ContainerInterface::class);
        $client = new Client([
            'base_uri' => 'http://127.0.0.1:8000',
            'timeout' => 2,
            'handler' => (new ClientInvokerStub(['code' => 500, 'message' => 'Server Error']))($container),
        ]);

        $auth = $client->check(1, 1, '/', 'GET');
        $this->assertSame(Auth::FAILED, $auth->getResult());
        $this->assertFalse($auth->isSuccess());
        $this->assertSame('Server Error', $auth->getMessage());
    }
}
