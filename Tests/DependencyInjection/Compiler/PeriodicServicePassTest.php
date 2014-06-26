<?php
/**
 * This file is part of the "LitGroupEventLoopBundle" package.
 *
 * (c) Roman Shamritskiy <roman@litgroup.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LitGroup\Bundle\EventLoopBundle\Tests\DependencyInjection\Compiler;


use LitGroup\Bundle\EventLoopBundle\DependencyInjection\Compiler\PeriodicServicePass;
use LitGroup\Bundle\EventLoopBundle\Tests\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class PeriodicServicePassTest extends TestCase
{
    /** @test */
    public function testNoPeriodicServiceDefined()
    {
        $container = new ContainerBuilder();
        $pass      = new PeriodicServicePass();

        $loop = $container->register('litgroup_event_loop');
        $pass->process($container);

        $this->assertCount(0, $loop->getMethodCalls());
    }

    /** @test */
    public function testPeriodicServiceDefined()
    {
        $container = new ContainerBuilder();
        $pass      = new PeriodicServicePass();
        $loop      = $container->register('litgroup_event_loop');
        $periodic  = $container
            ->register('periodic_service')
            ->addTag('litgroup_event_loop.periodic', ['interval' => '1000ms', 'method' => 'tick']);

        $pass->process($container);

        $this->assertCount(1, $loop->getMethodCalls());

        list ($method, list ($interval, $callback)) = $loop->getMethodCalls()[0];
        $this->assertSame('addPeriodicTimer', $method);
        $this->assertSame(1.0, $interval);
        $this->assertInstanceOf('Symfony\Component\DependencyInjection\Reference', $callback[0]);
        $this->assertEquals('periodic_service', $callback[0]);
        $this->assertSame('tick', $callback[1]);
    }

    public function getInvalidArgumentExceptionTests()
    {
        return [
            [[]],                                           // Required attributes missed
            [['interval' => '1s']],                         // Method is missed
            [['method'   => 'tick']],                       // Interval is  missed
            [['interval' => null, 'method' => 'tick']],     // Interval is null
            [['interval' => '1s', 'method' => null]],       // Method is null
            [['interval' => '0.0001', 'method' => 'tick']], // Interval < 1ms
            [['interval' => '-1s', 'method' => 'tick']],    // Interval can't be negative
        ];
    }

    /**
     * @dataProvider getInvalidArgumentExceptionTests
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidArgumentException(array $arguments)
    {
        $container = new ContainerBuilder();
        $pass      = new PeriodicServicePass();
        $loop      = $container->register('litgroup_event_loop');
        $periodic  = $container
            ->register('periodic_service')
            ->addTag('litgroup_event_loop.periodic', $arguments);

        $pass->process($container);
    }

}