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


    /**
     * @param $length
     * @dataProvider textLengthProvider
     */
    public function testGenerateRandomString($length)
    {
        $pwHelper = new PasswordHelper;
        $randomString = $pwHelper->generateRandomString($length);
        $this->assertNotEmpty($randomString);
        $this->assertEquals($length, strlen($randomString));
    }

    /**
     * @param $length
     * @dataProvider textLengthProvider
     */
    public function testRandomStringCharacters($length)
    {
        $pwHelper = new PasswordHelper;
        $randomString = $pwHelper->generateRandomString($length);
        $isValidString = $this->isValidRandomString($randomString);
        $this->assertTrue($isValidString);

        // Adding an invalid character to the string and testing for false
        $randomString .= '~';
        $isValidString = $this->isValidRandomString($randomString);
        $this->assertFalse($isValidString);
    }

    /**
     * @return array
     */
    public function textLengthProvider()
    {
        return array(
            array(rand(6, 64)), array(rand(6, 64)), array(rand(6, 64)), array(rand(6, 64)),
            array(rand(6, 64)), array(rand(6, 64)), array(rand(6, 64)), array(rand(6, 64)),
            array(rand(6, 64)), array(rand(6, 64)), array(rand(6, 64)), array(rand(6, 64)),
            array(rand(6, 64)), array(rand(6, 64)), array(rand(6, 64)), array(rand(6, 64)),
            array(rand(6, 64)), array(rand(6, 64)), array(rand(6, 64)), array(rand(6, 64)),
            array(rand(6, 64)), array(rand(6, 64)), array(rand(6, 64)), array(rand(6, 64)),
            array(rand(6, 64)), array(rand(6, 64)), array(rand(6, 64)), array(rand(6, 64)),
            array(rand(6, 64)), array(rand(6, 64)), array(rand(6, 64)), array(rand(6, 64)),
            array(rand(6, 64)), array(rand(6, 64)), array(rand(6, 64)), array(rand(6, 64)),
            array(rand(6, 64)), array(rand(6, 64)), array(rand(6, 64)), array(rand(6, 64)),
        );
    }

    /**
     * @param $randomString
     * @return bool
     */
    public function isValidRandomString($randomString)
    {
        $isValidString = true;
        if (preg_match('/[^a-zA-Z0-9+\/\*\-#$@%<>\(\)]/i', $randomString, $preg)) {
            //var_export($preg);
            $isValidString = false;
        }
        return $isValidString;
    }

    /**
     *
     */
    public function testHashStringWithSalt()
    {

    }

    /**
     *
     */
    public function testGeneratePassword()
    {

    }

}
 