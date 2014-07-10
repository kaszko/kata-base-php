<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/9/2014
 * Time: 5:29 PM
 */

namespace Kata\Test\Kata02;

use Kata\Kata02\Karate;

class KarateTest extends \PHPUnit_Framework_TestCase {

    public function testNoMatches() {

        $this->assertEquals(-1, Karate::Chop(500, array(0,50,100)));
        $this->assertEquals(-1, Karate::Chop(30, array(0,50)));
    }

    public function testEmptyArray() {
        $this->assertEquals(-1, Karate::Chop(30, array()));
    }

/*    public function testGetMiddleIdxOfArray() {
        $this->assertEquals(0, Karate::getMiddleIdxOfArray(array(1)));
        $this->assertEquals(0, Karate::getMiddleIdxOfArray(array(1,2)));
        $this->assertEquals(1, Karate::getMiddleIdxOfArray(array(1,2,3)));
        $this->assertEquals(1, Karate::getMiddleIdxOfArray(array(1,3,4,5)));
        $this->assertEquals(2, Karate::getMiddleIdxOfArray(array(2,3,4,5,6)));
        $this->assertEquals(2, Karate::getMiddleIdxOfArray(array(1,3,4,15,26,70)));
    }*/

    public function testValueAtIndexMatches() {
        $this->assertTrue(Karate::valueAtIndexMatches(15, 3, array(1,3,4,15,26,70)));
        $this->assertFalse(Karate::valueAtIndexMatches(15, 2, array(1,3,4,15,26,70)));
        $this->assertFalse(Karate::valueAtIndexMatches(15, 300, array(1,3,4,15,26,70)));

    }

    public function testGetMiddleIdxOfMinMaxIdx() {
        $this->assertEquals(0, Karate::getMiddleIdxOnMinMaxIdx(0,0));
        $this->assertEquals(0, Karate::getMiddleIdxOnMinMaxIdx(0,1));
        $this->assertEquals(1, Karate::getMiddleIdxOnMinMaxIdx(0,2));
        $this->assertEquals(1, Karate::getMiddleIdxOnMinMaxIdx(0,3));
        $this->assertEquals(1, Karate::getMiddleIdxOnMinMaxIdx(1,2));
        $this->assertEquals(5, Karate::getMiddleIdxOnMinMaxIdx(4,6));
    }

    public function testMiddleItemMatching() {

        $this->assertEquals(1, Karate::Chop(50, array(0,50,100)));
        $this->assertEquals(0, Karate::Chop(0, array(0,50)));
    }

    public function testLeftItemMatching() {

        $this->assertEquals(0, Karate::Chop(0, array(0,50,100)));
        $this->assertEquals(0, Karate::Chop(3, array(3,50,100)));
        $this->assertEquals(0, Karate::Chop(0, array(0,2,50,100)));
        $this->assertEquals(0, Karate::Chop(0, array(0,2,50,55,100)));

        // general
        $this->assertEquals(1, Karate::Chop(2, array(0,2,50,55,100)));

    }

    public function testRightItemMatching() {
        $this->assertEquals(2, Karate::Chop(100, array(0,50,100)));
        $this->assertEquals(2, Karate::Chop(110, array(3,50,110)));
        $this->assertEquals(2, Karate::Chop(50, array(0,2,50,100)));
    }



    /**
     * @dataProvider karateChopDataProvider
     * @param array $list
     * @param $needleInt
     * @param $index
     */
    public function testChop(array $list, $needleInt, $index) {
        $this->assertEquals($index, Karate::chop($needleInt, $list));
    }

    public function devChopDataProvider() {
        return array(
            array(array(1,2,3,4,5), 2, 1),
        );
    }

    public function karateChopDataProvider()
    {
        $three = range(1, 5, 2);
        $four  = range(1, 7, 2);
        return array(
            // Empty list.
            array(array(), 3, -1),
            // Single value.
            array(array(1), 3, -1),
            array(array(1), 1, 0),
            // Odd list with search for each number.
            array($three, 1, 0),
            array($three, 3, 1),
            array($three, 5, 2),
            // Odd list with intermediate search.
            array($three, 0, -1),
            array($three, 2, -1),
            array($three, 4, -1),
            array($three, 6, -1),
            // Even list with search for each number.
            array($four, 1, 0),
            array($four, 3, 1),
            array($four, 5, 2),
            array($four, 7, 3),
            // Even list with intermediate search.
            array($four, 0, -1),
            array($four, 2, -1),
            array($four, 4, -1),
            array($four, 6, -1),
            array($four, 8, -1),
            // Long list.
            array(array(1, 3, 5, 7, 8, 10, 11, 22, 23), 22, 7),
            array(array(1, 3, 5, 7, 8, 10, 15, 22, 23), 15, 6),
            array(range(1, 31), 5, 4)
        );
    }
}
 