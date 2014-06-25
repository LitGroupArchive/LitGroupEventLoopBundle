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
use React\EventLoop\LoopInterface;

/**
 * This interface should be implemented by any event loop factory.
 *
 * @author Roman Shamritskiy <roman@litgroup.ru>
 */
interface LoopFactoryInterface
{
    /**
     * Instantiates and returns event loop.
     *
     * @return LoopInterface
     */
    public function create();
} 