<?php
/**
 * This file is part of the "LitGroupEventLoopBundle" package.
 *
 * (c) Roman Shamritskiy <roman@litgroup.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LitGroup\Bundle\EventLoopBundle\Tests;


use LitGroup\Bundle\EventLoopBundle\LitGroupEventLoopBundle;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;

class LitGroupEventLoopBundleTest extends TestCase
{
    public function getBuildTests()
    {
        return [
            ['LitGroup\Bundle\EventLoopBundle\DependencyInjection\Compiler\PeriodicServicePass', PassConfig::TYPE_BEFORE_OPTIMIZATION],
        ];
    }

    /** @dataProvider getBuildTests */
    public function testBuild($expectedPass, $expectedType)
    {
        $bundle    = new LitGroupEventLoopBundle();
        $container = $this->getMock('Symfony\Component\DependencyInjection\ContainerBuilder', array(), array(), '', false);

        $container
            ->expects($this->atLeastOnce())
            ->method('addCompilerPass')
            ->with($this->equalTo(new $expectedPass), $this->identicalTo($expectedType))
        ;

        $bundle->build($container);
    }

}
 