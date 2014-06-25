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


use LitGroup\Bundle\EventLoopBundle\DefaultLoopFactory;

class DefaultLoopFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function testCreate()
    {
        $factory = new DefaultLoopFactory();
        $loop    = $factory->create();

        $this->assertInstanceOf('React\EventLoop\LoopInterface', $loop);
    }
}
 