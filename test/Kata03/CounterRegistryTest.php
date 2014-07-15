<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/13/2014
 * Time: 1:58 AM
 */

namespace Kata\Test\Kata03;



use Kata\Kata03\Counter;
use Kata\Kata03\CounterRegistry;
use Kata\Kata03\TimerCounter;

class CounterRegistryTest extends \PHPUnit_Framework_TestCase {

    public function testFactoryCounter() {
        $counter = CounterRegistry::factoryCounter();
        $this->assertTrue($counter instanceof TimerCounter);
    }

    public function testCounterRegistry() {
        $dataType = CounterRegistry::DATATYPE_IP;
        $dataValue = '192.168.0.1';
        $counter = CounterRegistry::getCounterFor($dataType, $dataValue);
        $this->assertTrue($counter instanceof TimerCounter);
        $this->assertEquals(0, $counter->getCount());

        $counter->increase();
        $this->assertEquals(1, $counter->getCount());

        $counter2 = CounterRegistry::getCounterFor($dataType, $dataValue);
        $this->assertEquals($counter, $counter2);
        $this->assertEquals(1, $counter2->getCount());

        $dataValueOther = '10.0.0.5';
        $counter3 = CounterRegistry::getCounterFor($dataType, $dataValueOther);
        $this->assertTrue($counter3 instanceof TimerCounter);
        $this->assertEquals(0, $counter3->getCount());

    }

    public function testReset() {
        $dataType = CounterRegistry::DATATYPE_IP;
        $dataValue = '192.168.0.1';
        $counter = CounterRegistry::getCounterFor($dataType, $dataValue);
        $this->assertTrue($counter instanceof TimerCounter);
        $this->assertEquals(0, $counter->getCount());

        $counter->increase();
        $this->assertEquals(1, $counter->getCount());

        CounterRegistry::resetCounters();
        $counter = CounterRegistry::getCounterFor($dataType, $dataValue);
        $this->assertEquals(0, $counter->getCount());
    }
}
 