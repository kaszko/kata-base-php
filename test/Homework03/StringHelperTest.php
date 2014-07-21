<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/20/2014
 * Time: 10:24 PM
 */

namespace Kata\Test\Homework03;

use Kata\Homework03\StringHelper;


class StringHelperTest extends \PHPUnit_Framework_TestCase {
    public function testIsPalindromDummy() {
        $this->assertEquals(true, StringHelper::isPalindrom(''));
        $this->assertEquals(true, StringHelper::isPalindrom('a'));



    }

    public function testMirrorPosition() {
        $this->assertEquals(0, StringHelper::mirrorPosition('', 0));
        $this->assertEquals(0, StringHelper::mirrorPosition('a', 0));

        $this->assertEquals(1, StringHelper::mirrorPosition('ab', 0));
        $this->assertEquals(2, StringHelper::mirrorPosition('abc', 0));
        $this->assertEquals(1, StringHelper::mirrorPosition('abc', 1));

        $this->assertEquals(0, StringHelper::mirrorPosition('abc', 2));
        $this->assertEquals(0, StringHelper::mirrorPosition('ab', 1));
    }

    public function testIsPalindromAny() {
        $this->assertEquals(false, StringHelper::isPalindrom('ab'));

        $this->assertEquals(true, StringHelper::isPalindrom('aba'));
        $this->assertEquals(true, StringHelper::isPalindrom('abba'));
    }
}
 