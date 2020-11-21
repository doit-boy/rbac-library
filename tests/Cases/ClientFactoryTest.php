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

use DoitBoy\RBAC\Client;
use DoitBoy\RBAC\ClientFactory;
use DoitBoy\RBAC\Contract\HandlerInvokerInterface;
use GuzzleHttp\HandlerStack;
use Hyperf\Config\Config;
use Hyperf\Contract\ConfigInterface;
use Mockery;
use Psr\Container\ContainerInterface;

/**
 * @internal
 * @coversNothing
 */
class ClientFactoryTest extends AbstractTestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
    }

    public function testOptionsForClientFactory()
    {
        $container = Mockery::mock(ContainerInterface::class);
        $container->shouldReceive('get')->with(ConfigInterface::class)->andReturn(new Config([
            'rbac' => [
                'options' => $options = [
                    'base_uri' => 'http://rbac_api:8000',
                    'timeout' => 2,
                ],
            ],
        ]));

        $factory = new ClientFactory();
        $client = $factory($container);
        $this->assertInstanceOf(Client::class, $client);
        $this->assertSame($options, $client->getOptions());
    }

    public function testClientInvokerInClientFactory()
    {
        $container = Mockery::mock(ContainerInterface::class);
        $container->shouldReceive('get')->with(ConfigInterface::class)->andReturn(new Config([
            'rbac' => [
                'options' => $options = [
                    'base_uri' => 'http://rbac_api:8000',
                    'handler' => new class() implements HandlerInvokerInterface {
                        public function __invoke(ContainerInterface $container): HandlerStack
                        {
                            return new HandlerStack(new class() {
                                public function isMock()
                                {
                                    return true;
                                }

                                public function __invoke()
                                {
                                }
                            });
                        }
                    },
                    'timeout' => 2,
                ],
            ],
        ]));

        $factory = new ClientFactory();
        $client = $factory($container);
        $handler = $client->getOptions()['handler'];
        $this->assertInstanceOf(HandlerStack::class, $handler);
        $ref = new \ReflectionClass($handler);
        $property = $ref->getProperty('handler');
        $property->setAccessible(true);
        $handler = $property->getValue($handler);
        $this->assertTrue($handler->isMock());
    }
}
