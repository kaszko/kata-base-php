<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 3/31/2015
 * Time: 9:54 PM
 */

namespace Kata\Test\Intervaller;

use Kata\Intervaller\Interval;
use Kata\Intervaller\IntervalGenerator;

class IntervalGeneratorTest extends \PHPUnit_Framework_TestCase {
    private $generator;

    protected function setUp()
    {
        $this->generator = new IntervalGenerator();
    }

    /**
     * @dataProvider intervalDataProvider
     * @param array $numbers
     * @param array $expectedIntervals
     */
    public function testGenerate(array $numbers, array $expectedIntervals)
    {
        foreach ($numbers as $number)
        {
            $this->generator->add($number);
        }

        $this->assertEquals($expectedIntervals, $this->generator->getIntervals());
    }

    public function intervalDataProvider()
    {
        return array(
            array(
                array(1, 2, 3),
                array(
                    new Interval(1, 3),
                )
            ),
            array(
                array(1, 3),
                array(
                    new Interval(1),
                    new Interval(3),
                )
            ),
            array(
                array(1, 2, 30, 31, 32, 40),
                array(
                    new Interval(1, 2),
                    new Interval(30, 32),
                    new Interval(40, 40),
                )
            ),
        );
    }
}
