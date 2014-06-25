<?php
/**
 * This file is part of the "LitGroupEventLoopBundle" package.
 *
 * (c) Roman Shamritskiy <roman@litgroup.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LitGroup\Bundle\EventLoopBundle;
use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;


/**
 * Default implementation of the LoopFactoryInterface.
 *
 * @use \React\EventLoop\Factory
 *
 * @author Roman Shamritskiy <roman@litgroup.ru>
 */
class DefaultLoopFactory implements LoopFactoryInterface
{
    /**
     * Instantiates and returns event loop.
     *
     * @return LoopInterface
     */
    public function create()
    {
        return Factory::create();
    }

} 