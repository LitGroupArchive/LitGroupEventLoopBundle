<?php
/**
 * This file is part of the "LitGroupEventLoopBundle" package.
 *
 * (c) Roman Shamritskiy <roman@litgroup.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LitGroup\Bundle\EventLoopBundle\Tests\DependencyInjection;


use LitGroup\Bundle\EventLoopBundle\DependencyInjection\LitGroupEventLoopExtension;
use LitGroup\Bundle\EventLoopBundle\Tests\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class LitGroupEventLoopExtensionTest extends TestCase
{
    /** @test */
    public function testLoopService()
    {
        $container = new ContainerBuilder();
        $extension = new LitGroupEventLoopExtension();
        $extension->load([], $container);

        $this->assertTrue($container->hasDefinition('litgroup_event_loop'), 'Service "litgroup_event_loop" is not defined.');

        $definition = $container->getDefinition('litgroup_event_loop');
        $this->assertEquals('React\EventLoop\LoopInterface', $definition->getClass());
        $this->assertEquals('React\EventLoop\Factory', $definition->getFactoryClass());
        $this->assertEquals('create', $definition->getFactoryMethod());
        $this->assertTrue($definition->isPublic());

        return $container;
    }

    /** @depends testLoopService */
    public function testLoopServiceIsSingleton(ContainerBuilder $container)
    {
        $container->compile();

        $loop1 = $container->get('litgroup_event_loop');
        $loop2 = $container->get('litgroup_event_loop');

        $this->assertInstanceOf('React\EventLoop\LoopInterface', $loop1);
        $this->assertInstanceOf('React\EventLoop\LoopInterface', $loop2);

        $this->assertSame($loop1, $loop2, 'The "litgroup_event_loop" service is not a singleton');
    }
}
 