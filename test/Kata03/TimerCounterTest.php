<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/12/2014
 * Time: 11:32 PM
 */

namespace Kata\Test\Kata03;

use Kata\Kata03\TimerCounter;

class TimerCounterTest extends \PHPUnit_Framework_TestCase {

    /**
     *
     * @dataProvider countDataProvider
     * @param $countTo
     */
    public function xtestCount($countTo) {
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
     */
    public function testTimeOut() {
        $counter = new TimerCounter();
        $counter->setTimeBlockSize(5);
        $counter->setTimeOut(10);
        $counter->increase();
        $this->assertEquals(1, $counter->getCount());
        sleep(11);
        $this->assertEquals(0, $counter->getCount());
        $counter->increase();
        $this->assertEquals(1, $counter->getCount());
        sleep(3);
        $this->assertEquals(1, $counter->getCount());
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
 