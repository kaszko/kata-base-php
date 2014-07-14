<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/12/2014
 * Time: 11:32 PM
 */

namespace Kata\Test\Kata03;

use Kata\Kata03\TimerCounter;
use Kata\Kata03\Counter;

class TimerCounterTest extends \PHPUnit_Framework_TestCase {

    /**
     *
     * @dataProvider countDataProvider
     * @param $countTo
     */
    public function testCount($countTo) {
        $counter = new TimerCounter();
        $this->assertEquals(0, $counter->getCount());
        for ($x=0;$x<$countTo;$x++) {
            $counter->increase();
        }

        $this->assertEquals($countTo, $counter->getCount());
    }

    /**
     * Ismertem, hogy timeblock hasznalat engedelyezett, ezert a kapcsolodo funkciokat tesztelem
     *
     * @throws \Exception
     */
    public function testTimeBlockHandling() {
        $counter = new TimerCounter();
        $counter->setTimeBlockSize(5);

        $method = new \ReflectionMethod('\\Kata\\Kata03\\TimerCounter', '_getTimeBlockKeyForUnixTime');
        $method->setAccessible(true);
        $this->assertEquals(10, $method->invoke($counter, 13));
        $this->assertEquals(15, $method->invoke($counter, 15));
    }

    /**
     * @expectedException \Exception
     * @dataProvider setTimeBlockErrorDataProvider
     */
    public function testTimeBlockError($invalidTimeBlock) {
        $counter = new TimerCounter();
        $counter->setTimeBlockSize($invalidTimeBlock);
    }

    /**
     * Valodi timeout teszteles
     *
     * @throws \Exception
     * @todo mock the time !:)
     */
    public function testTimeOut() {
//        $counter = new TimerCounter();
//        $counter->setTimeBlockSize(5);
//        $counter->setTimeOut(10);
//        $counter->increase();
//        $this->assertEquals(1, $counter->getCount());
//        sleep(11);
//        $this->assertEquals(0, $counter->getCount());
//        $counter->increase();
//        $this->assertEquals(1, $counter->getCount());
//        sleep(3);
//        $this->assertEquals(1, $counter->getCount());
    }

    public function testTimeOutWithMockedTime() {
        $counter = new TimerCounter();
        $counter->setTimeBlockSize(300);
        $counter->setTimeOut(3600);

        $method = new \ReflectionMethod('\\Kata\\Kata03\\TimerCounter', '_getTimeBlockKeyForUnixTime');
        $method->setAccessible(true);

        $counterRefl = new \ReflectionClass('\\Kata\\Kata03\\Counter');
        $rProp = $counterRefl->getProperty('_count');
        $rProp->setAccessible(true);

        $counter1 = new Counter();
        $rProp->setValue($counter1, 1723);
        $counter2 = new Counter();
        $rProp->setValue($counter2, 1230);
        $counter3 = new Counter();
        $rProp->setValue($counter3, 55);

        $mockTimeBlocks = array(
            $method->invoke($counter, time() - 10000) => $counter1, // timed out row
            $method->invoke($counter, time() - 1000) => $counter2,
            $method->invoke($counter, time() - 300) => $counter3,
        );

        $r = new \ReflectionClass('\\Kata\\Kata03\\TimerCounter');
        $rProp = $r->getProperty('_timeBlocksCounters');
        $rProp->setAccessible(true);
        $rProp->setValue($counter, $mockTimeBlocks);

        $this->assertEquals(1285, $counter->getCount());


    }

    /**
     * @expectedException \Exception
     * @dataProvider setTimeBlockErrorDataProvider
     */
    public function testTimeOutError($invalidTimeOut) {
        $counter = new TimerCounter();
        $counter->setTimeOut($invalidTimeOut);
    }

    ////////////////////////////////

    public function setTimeBlockErrorDataProvider() {
        return array(
            array(new \StdClass()),
            array(-1),
            array(0),
        );
    }

    public function countDataProvider() {
        $array = array();
        for ($x=0; $x<3; $x++) {
            $array[] = array(mt_rand(0, 1000000));
        }
        return $array;
    }
}
 