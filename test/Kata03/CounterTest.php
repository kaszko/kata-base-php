<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/12/2014
 * Time: 11:21 PM
 */

namespace Kata\Test\Kata03;

use Kata\Kata03\Counter;

class CounterTest extends \PHPUnit_Framework_TestCase {

    /**
     *
     * @dataProvider countDataProvider
     * @param $countTo
     */
    public function testCount($countTo) {
        $counter = new Counter();
        $this->assertEquals(0, $counter->getCount());
        for ($x=0;$x<$countTo;$x++) {
            $counter->increase();
        }

        $this->assertEquals($countTo, $counter->getCount());
    }

    public function countDataProvider() {
        $array = array();
        for ($x=0; $x<20; $x++) {
            $array[] = array(mt_rand(0, 1000000));
        }
        return $array;
    }

    public function testCountBy() {
        $counter = new Counter();
        $this->assertEquals(0, $counter->getCount());
        $counter->increase(99);
        $this->assertEquals(99, $counter->getCount());
    }
}
 