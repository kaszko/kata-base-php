<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 8/6/2014
 * Time: 5:33 PM
 */

namespace Kata\Test\RegistrationSystem;
use Kata\RegistrationSystem\Exception\NotStringException;
use Kata\RegistrationSystem\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Validator
     */
    private $validator;

    /**
     *
     */
    protected function setUp() {
        $this->validator = new Validator();
    }

    /**
     * @dataProvider emailDataProvider
     * @param $email
     * @param $valid
     */
    public function testEmailValidation($email, $valid) {
        $this->assertEquals($valid, $this->validator->isValidEmail($email));
    }

    /**
     * @dataProvider passwordDataProvider
     * @param $password
     * @param $valid
     */
    public function testPasswordValidation($password, $valid) {
        $this->assertEquals($valid, $this->validator->isValidPlainPassword($password));
    }

    /**
     * @return array
     */
    public function emailDataProvider() {
        return array(
            array('kolos@escalion.com', true),
            array('demo@exampole.co.uk', true),
            array('tittel-andor.test_fr@doclerholding.com', true),
            array('test@gmail.com', true),
            array('k@a.', false),
            array('asd', false),
            array('000', false),
            array(array(1), false),
            array(new \stdClass(), false),
        );
    }

    public function passwordDataProvider() {
        return array(
            array('asdassd1231231', true),
            array('asdad894+!)(!+)', true),
            array(md5(time()) . md5(time()) . md5(time()), false),
            array('as', false),
            array('1', false),
            array(array(1), false),
            array(new \stdClass(), false),
        );
    }
}
 