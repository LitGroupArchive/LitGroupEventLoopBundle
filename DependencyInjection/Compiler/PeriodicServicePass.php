<?php
/**
 * This file is part of the "LitGroupEventLoopBundle" package.
 *
 * (c) Roman Shamritskiy <roman@litgroup.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LitGroup\Bundle\EventLoopBundle\DependencyInjection\Compiler;


use LitGroup\Bundle\EventLoopBundle\Util\TimeUnit;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Roman Shamritskiy <roman@litgroup.ru>
 *
 * @uses \LitGroup\Bundle\EventLoopBundle\Util\TimeUnit
 */
class PeriodicServicePass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $services = $container->findTaggedServiceIds('litgroup_event_loop.periodic');

        if (count($services) === 0) {
            return;
        }

        $loop = $container->getDefinition('litgroup_event_loop');

        foreach ($services as $service => $tags) {
            foreach ($tags as $attributes) {
                list($interval, $method) = $this->processTagAttributes($attributes);
                $callback                = [new Reference($service), $method];
                $loop->addMethodCall('addPeriodicTimer', [$interval, $callback]);
            }
        }

    }

    /**
     * @param array $attributes
     *
     * @return array
     *
     * @throws \InvalidArgumentException
     */
    private function processTagAttributes(array $attributes)
    {
        if (!isset($attributes['method']) || empty($attributes['method'])) {
            throw new \InvalidArgumentException(
                '"method" attribute is required for "litgroup_event_loop.periodic" tag.');
        } elseif (!isset($attributes['interval']) || empty($attributes['interval'])) {
            throw new \InvalidArgumentException(
                '"interval" attribute is required for "litgroup_event_loop.periodic" tag.');
        }

        try {
            $interval = TimeUnit::toSeconds($attributes['interval']);
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException(
                '"interval" attribute in "litgroup_event_loop.periodic" tag is invalid', 0, $e);
        }

        if ($interval < 0.001) {
            throw new \InvalidArgumentException('"interval" can not be less than 1ms in "litgroup_event_loop.periodic" tag');
        }

        return [$interval, $attributes['method']];

    }

} 