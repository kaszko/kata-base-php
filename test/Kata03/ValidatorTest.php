<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/13/2014
 * Time: 11:47 AM
 */

namespace Kata\Test\Kata03;

use Kata\Kata03\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase {
    public function testValidateNumber() {
        $this->assertTrue(Validator::validateNumber(-54));
        $this->assertTrue(Validator::validateNumber(1));
        $this->assertTrue(Validator::validateNumber(3.5));
        $this->assertTrue(Validator::validateNumber(99999));
    }

    /**
     * @param $errorValue
     * @expectedException \Exception
     * @dataProvider invalidNumberProvider
     */
    public function testExceptionOfValidateNumberMinimumValueOne($errorValue) {
        Validator::validateNumber($errorValue);
    }

    public function testValidateMinimumValue() {
        $this->assertTrue(Validator::validateMinimumValue(-54, -70));
        $this->assertTrue(Validator::validateMinimumValue(1, 1));
        $this->assertTrue(Validator::validateMinimumValue(3.5, 3));
        $this->assertTrue(Validator::validateMinimumValue(99999, 9998));
    }


    public function invalidNumberProvider() {
        return array(
            array('asd'),
            array(new \StdClass()),
            array(function() { echo 1;}),
        );

    }
}
 