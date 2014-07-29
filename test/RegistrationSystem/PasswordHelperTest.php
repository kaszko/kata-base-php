<?php
/**
 * Created by PhpStorm.
 * User: Pot
 * Date: 7/29/2014
 * Time: 6:49 PM
 */

namespace Kata\Test\RegistrationSystem;
use Kata\RegistrationSystem\PasswordHelper;

class PasswordHelperTest extends \PHPUnit_Framework_TestCase {


    public function testGenerateRandomString()
    {
        $length = 12;
        $pwHelper = new PasswordHelper;
        $randomString = $pwHelper->generateRandomString($length);
        $this->assertNotEmpty($randomString);
        $this->assertEquals($length, strlen($randomString));
    }
}
 