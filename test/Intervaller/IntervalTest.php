<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 3/31/2015
 * Time: 9:39 PM
 */

namespace Kata\Test\Intervaller;

use Kata\Intervaller\Interval;

class IntervalTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateWithMin()
    {
        $interval = new Interval(30);
        $this->assertEquals(new Interval(30, 30), $interval);
    }

    public function testAddNext()
    {
        $interval = new Interval(30);
        $addResult = $interval->add(31);

        $this->assertSame(true, $addResult);
        $this->assertEquals(new Interval(30, 31), $interval);
    }

    public function testAddPrevious()
    {
        $interval = new Interval(30);
        $addResult = $interval->add(29);

        $this->assertSame(true, $addResult);
        $this->assertEquals(new Interval(29, 30), $interval);
    }

    public function testAddFailure()
    {
        $interval = new Interval(30, 50);
        $addResult = $interval->add(55);

        $this->assertSame(false, $addResult);
        $this->assertEquals(new Interval(30, 50), $interval);
    }

    public function testAddInternal()
    {
        $interval = new Interval(30, 40);
        foreach (range(30, 40) as $tryNumber)
        {
            $addResult = $interval->add($tryNumber);

            $this->assertSame(true, $addResult);
            $this->assertEquals(new Interval(30, 40), $interval);

        }
    }
}