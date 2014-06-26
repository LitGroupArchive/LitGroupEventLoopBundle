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

use LitGroup\Bundle\EventLoopBundle\DependencyInjection\Compiler\PeriodicServicePass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * LitGroupEventLoopBundle
 *
 * @author Roman Shamritskiy <roman@litgroup.ru>
 */
class LitGroupEventLoopBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new PeriodicServicePass());
    }

}
