<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/24/2014
 * Time: 9:15 AM
 */

namespace Kata\Test\Bergman\Counter;

use Kata\Bergman\Counter\Counter;

class CounterTest extends \PHPUnit_Framework_TestCase {

    private $counter;

    public function setUp() {
        $this->counter = new Counter();
    }

    public function testNextCallsWithDefaultIncrement() {
        
        $this->assertEquals(1, $this->counter->next());
        $this->assertEquals(2, $this->counter->next());
        $this->assertEquals(3, $this->counter->next());
        $this->assertEquals(4, $this->counter->next());

        return $this->counter;
    }

    /**
     * @depends testNextCallsWithDefaultIncrement
     */
    public function testNextCallsWithCustomIncrement(Counter $counter) {
        
        $counter->setIncrement(5);
        $this->assertEquals(9, $counter->next());
        $this->assertEquals(14, $counter->next());
        $this->assertEquals(19, $counter->next());
        $this->assertEquals(24, $counter->next());

        $counter->setIncrement(0);
        $this->assertEquals(24, $counter->next());
        $this->assertEquals(24, $counter->next());
        $this->assertEquals(24, $counter->next());
        $this->assertEquals(24, $counter->next());
    }

    /**
     * @dataProvider invalidIncrementDataProvider
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidIncrementException($invalidIncrementArgument) {
        
        $this->counter->setIncrement($invalidIncrementArgument);
    }

    public function testNextCallsWithNegativeIncrement() {
        
        $this->counter->setIncrement(-2);
        $this->assertEquals(-2, $this->counter->next());
        $this->assertEquals(-4, $this->counter->next());
        $this->assertEquals(-6, $this->counter->next());
        $this->assertEquals(-8, $this->counter->next());
    }

    public function testChangeIncrementValueInRuntime() {
        
        $this->counter->setIncrement(-2);
        $this->assertEquals(-2, $this->counter->next());
        $this->assertEquals(-4, $this->counter->next());
        $this->counter->setIncrement(10);
        $this->assertEquals(6, $this->counter->next());
        $this->assertEquals(16, $this->counter->next());
    }

    public function testPrivateAttributes() {

    }

    /////////////////

    public function invalidIncrementDataProvider() {
        return array(
            array('asd'),
            array('5.68'),
            array(new \stdClass()),
            array(array('sdjaads')),

        );
    }
}
 