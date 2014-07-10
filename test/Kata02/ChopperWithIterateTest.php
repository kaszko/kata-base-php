<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/9/2014
 * Time: 7:02 PM
 */

namespace Kata\Test\Kata02;

use Kata\Kata02\ChopperWithIterate;

class ChopperWithIterateTest extends \PHPUnit_Framework_TestCase {

    private $chopper;

    public function setUp() {

    }

    public function testNoMatches() {

        $this->chopper = new ChopperWithIterate(array(50,100));
        $this->assertEquals(-1, $this->chopper->getIndexOfValue(1));

        $this->chopper = new ChopperWithIterate(array(0,50));
        $this->assertEquals(-1, $this->chopper->getIndexOfValue(20));

        $this->chopper = new ChopperWithIterate(array(0,50));
        $this->assertEquals(-1, $this->chopper->getIndexOfValue(400));
    }

    public function testGetMiddleIndex() {
        $this->chopper = new ChopperWithIterate(array(0,50,100));
        $this->assertEquals(1, $this->chopper->getMiddleIndex());

        $this->chopper = new ChopperWithIterate(array(0,50));
        $this->assertEquals(0, $this->chopper->getMiddleIndex());

        $this->chopper = new ChopperWithIterate(array(0,50));
        $this->assertEquals(0, $this->chopper->getMiddleIndex());
    }

    public function testMiddleItemMatching() {
        $this->chopper = new ChopperWithIterate(array(0,50,100));
        $this->assertEquals(1, $this->chopper->getIndexOfValue(50));
    }

    public function testLeftItemMatching() {
        $this->chopper = new ChopperWithIterate(array(0,50,100));
        $this->assertEquals(0, $this->chopper->getIndexOfValue(0));

        $this->chopper = new ChopperWithIterate(array(3,50,100));
        $this->assertEquals(0, $this->chopper->getIndexOfValue(3));

        $this->chopper = new ChopperWithIterate(array(0,2,50,100));
        $this->assertEquals(0, $this->chopper->getIndexOfValue(0));

        $this->chopper = new ChopperWithIterate(array(0,2,50,55,100));
        $this->assertEquals(0, $this->chopper->getIndexOfValue(0));

        // general
        $this->chopper = new ChopperWithIterate(array(0,2,50,55,100));
        $this->assertEquals(1, $this->chopper->getIndexOfValue(2));

    }
}

 