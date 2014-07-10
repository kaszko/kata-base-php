<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/8/2014
 * Time: 8:42 PM
 */

namespace Kata\Test\Kata01;

use Kata\Kata01\Money;

class TestMoney extends \PHPUnit_Framework_TestCase {

    public function testCreateWithValue() {
        $m1 = new Money(100);
        $this->assertEquals(100, $m1->getValue());
        $m1 = new Money(10);
        $this->assertEquals(10, $m1->getValue());
        $m1 = new Money(5.5);
        $this->assertEquals(5.5, $m1->getValue());
    }

    public function testAddMoney() {
        $m1 = new Money(100);
        $m2 = $m1->addMoney(new Money(50));
        $this->assertEquals(150, $m2->getValue());
        $this->assertEquals($m2, new Money(150));
    }

    public function testSubMoney() {
        $m = (new Money(50))->subtractMoney(new Money(50));
        $this->assertEquals(0, $m->getValue());
        $this->assertEquals(new Money(0), $m);

        $m = (new Money(50))->subtractMoney(new Money(10));
        $this->assertEquals(40, $m->getValue());
        $this->assertEquals(new Money(40), $m);

        $m = (new Money(5))->subtractMoney(new Money(3.4));
        $this->assertEquals(1.6, $m->getValue());
        $this->assertEquals(new Money(1.6), $m);

        $m = (new Money(100.99))->subtractMoney(new Money(1.99));
        $this->assertEquals(99, $m->getValue());
        $this->assertEquals(new Money(99), $m);

    }

    /**
     * @expectedException \Exception
     */
    public function testCreateWithNegativeValue() {
        $m1 = new Money(-100);
    }

    /**
     * @expectedException \Exception
     */
    public function testSubtractToNegative() {
        $m = (new Money(5))->subtractMoney(50);
    }


}
 