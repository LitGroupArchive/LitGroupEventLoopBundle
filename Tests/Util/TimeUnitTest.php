<?php
/**
 * This file is part of the "LitGroupEventLoopBundle" package.
 *
 * (c) Roman Shamritskiy <roman@litgroup.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LitGroup\Bundle\EventLoopBundle\Tests\Util;


use LitGroup\Bundle\EventLoopBundle\Util\TimeUnit;

class TimeUnitTest extends \PHPUnit_Framework_TestCase
{
    public function getToSecondsTests()
    {
        return [
            [0.0,    0.0   ],
            ['0.0',  0.0   ],
            [100.0,  100.0 ],
            [100,    100.0 ],
            ['10',   10.0  ],
            ['10.0', 10.0  ],
            ['1ms',  0.001 ],
            ['1s',   1.0   ],
            ['1m',   60.0  ],
            ['1h',   3600.0],
            ['1.5h', 5400.0],
        ];
    }

    /** @dataProvider getToSecondsTests */
    public function testToSeconds($input, $expected)
    {
        $result = TimeUnit::toSeconds($input);

        $this->assertInternalType('float', $result);
        $this->assertEquals($expected, $result);
    }

    public function getToSecondsInvalidArgumentTests()
    {
        return [
            ['10 s'  ],
            ['10,3'  ],
            ['10,3m'  ],
            ['100d'  ],
            ['10h11m'],
        ];
    }

    /**
     * @dataProvider getToSecondsInvalidArgumentTests
     * @expectedException \InvalidArgumentException
     */
    public function testToSecondsInvalidArgument($input)
    {
        TimeUnit::toSeconds($input);
    }
}
 