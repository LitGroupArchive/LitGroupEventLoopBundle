<?php
/**
 * This file is part of the "LitGroupEventLoopBundle" package.
 *
 * (c) Roman Shamritskiy <roman@litgroup.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LitGroup\Bundle\EventLoopBundle\Util;


class TimeUnit
{
    /**
     * Parses time interval in seconds from string with time unit.
     *
     * Supported time units:
     *  - ms (milliseconds)
     *  - s (seconds)
     *  - m (minutes)
     *  - h (hours)
     *
     * If no time unit specified — interpreted as seconds.
     *
     * Example:
     *
     *     10   => 10.0
     *     10.0 => 10.0
     *     1ms  => 0.001
     *     1s   => 1.0
     *     1m   => 60.0
     *     1h   => 3600.0
     *     1.5h => 5400.0
     *
     * @param string|integer|double $interval
     *
     * @return double
     *
     * @throws \InvalidArgumentException
     */
    public static function toSeconds($interval)
    {
        if (is_numeric($interval)) {
            return (double) $interval;
        }

        $hasMatches = (bool) preg_match('/^([0-9]+(?:\.[0-9]+)?){1}(ms|s|m|h)?$/Ds', $interval, $matches);
        if (!$hasMatches) {
            throw new \InvalidArgumentException('Time interval is invalid.');
        }

        list (, $value, $unit) = $matches;
        $value = (double) $value;

        switch ($unit) {
            case 'ms':
                return $value / 1000.0;
            case 'm':
                return $value * 60.0;
            case 'h':
                return $value * 3600.0;
            default: // Interpreted as seconds (s)
                return $value;
        }
    }
} 