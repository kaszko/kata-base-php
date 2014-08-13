<?php
/**
 * Created by PhpStorm.
 * User: Pot
 * Date: 7/29/2014
 * Time: 6:49 PM
 *
 * PasswordHelper class tests
 *
 * @link https://confluence.doclerholding.com/pages/viewpage.action?pageId=52203382
 */

namespace Kata\Test\RegistrationSystem;

use Kata\RegistrationSystem\PasswordHelper;
use Kata\RegistrationSystem\Entity\Password;
use Kata\RegistrationSystem\Validator;


class PasswordHelperTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var PasswordHelper
     */
    private $passwordHelper;

    /**
     *
     */
    protected function setUp()
    {
        $this->passwordHelper = new PasswordHelper;
    }

    /**
     * Checks if the random string generator generates the required length string.
     *
     * @param $length
     * @dataProvider textLengthProvider
     */
    public function testGenerateRandomString($length)
    {
        $randomString = $this->passwordHelper->generateRandomString($length);
        $this->assertEquals($length, strlen($randomString));
    }

    /**
     * Checks if the random generated string contains only valid characters
     *
     * @see          $this->isValidRandomString
     * @param $length
     * @dataProvider textLengthProvider
     */
    public function testRandomStringCharacters($length)
    {
        $randomString = $this->passwordHelper->generateRandomString($length);
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
     * Decides if the $randomString contains only valid characters
     *
     * @link https://confluence.doclerholding.com/pages/viewpage.action?pageId=52203382
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
     * Checks if the hashed password length is exactly 40 characters long.
     *
     * @link https://confluence.doclerholding.com/pages/viewpage.action?pageId=52203382
     * @param $length
     * @dataProvider textLengthProvider
     */
    public function testHashStringWithSalt($length)
    {
        $userPassword = $this->passwordHelper->generateRandomString($length);
        $salt = $this->passwordHelper->generateRandomString($length);
        $hashedPassword = $this->passwordHelper->hashStringWithSalt($userPassword, $salt);
        $expectedHashLength = 40; //sha1 length default hexa
        $this->assertEquals($expectedHashLength, strlen($hashedPassword));

        $this->assertEquals($hashedPassword, $this->passwordHelper->hashStringWithSalt($userPassword, $salt));
    }

    /**
     * Checks if the generated password is an instance of Password class.
     *
     * @param $length
     * @dataProvider textLengthProvider
     */
    public function testGeneratePassword($length)
    {
        $plainPassword = $this->passwordHelper->generateRandomString($length);
        $password = $this->passwordHelper->generatePassword($plainPassword, $length);
        $this->assertInstanceOf('Kata\RegistrationSystem\Entity\Password', $password);
    }

}
 