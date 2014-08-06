<?php
/**
 * Created by PhpStorm.
 * User: Pot
 * Date: 7/30/2014
 * Time: 6:57 PM
 */

namespace Kata\Test\RegistrationSystem;
use Kata\RegistrationSystem\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Validator
     */
    protected $validator;

    /**
     *
     */
    protected function setUp()
    {
        $this->validator = new Validator;
    }

    /**
     * @param $email
     * @dataProvider validEmailProvider
     */
    public function testIsValidEmail($email)
    {
        //echo $email . PHP_EOL;
        $this->assertTrue($this->validator->isValidEmail($email));
    }

    /**
     * @return array
     */
    public function validEmailProvider()
    {
        for($i = 0; $i < 30; $i++) {
            $mails[] = array($this->generateRandomString() . '@'.$this->generateRandomString(3, 15).'.'.$this->generateRandomString(2, 4));
        }
        return $mails;
    }

    /**
     * @param $invalidMail
     * @dataProvider invalidEmailProvider
     */
    public function testIsInvalidEmail($invalidMail)
    {
        $this->assertFalse($this->validator->isValidEmail($invalidMail));
    }

    /**
     * @param $invalidMail
     * @dataProvider invalidEmailExceptionProvider
     * @expectedException \InvalidArgumentException
     */
    public function testIsInvalidEmailForException($invalidMail)
    {
        $this->validator->isValidEmail($invalidMail);
    }

    /**
     * @return array
     */
    public function invalidEmailProvider()
    {
        $mails = array();
        $mails[] = array($this->generateRandomString()); // no dot no at
        $mails[] = array($this->generateRandomString() . '.'); // no at
        $mails[] = array($this->generateRandomString() . '@'); // no dot
        return $mails;
    }

    /**
     * @return array
     */
    public function invalidEmailExceptionProvider()
    {
        $mails = array();
        $mails[] = array(array());
        $mails[] = array(new \StdClass);
        return $mails;
    }

    /**
     * @param $password
     * @dataProvider validPlainPasswordProvider
     */
    public function testIsValidPlainPassword($password)
    {
        $this->assertTrue($this->validator->isValidPlainPassword($password));
    }

    /**
     * @return array
     */
    public function validPlainPasswordProvider()
    {
        for($i = 0; $i < 30; $i++) {
            $mails[] = array($this->generateRandomString(6, 46));
        }
        return $mails;
    }


    /**
     * @return string
     */
    public function generateRandomString($min = 3, $max = 40) {
        $charSet = 'abcdefghijklmnopqrstuvwxyz';
        $str = '';
        for ($x = 0; $x<rand($min, $max); $x++) {
            $str .= substr($charSet, (int)(mt_rand(1,99999) % strlen($charSet)), 1);
        }
        return $str;
    }

}
 