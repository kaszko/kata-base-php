<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 8/12/2014
 * Time: 5:28 PM
 */

namespace Kata\Test\RegistrationSystem;


use Kata\RegistrationSystem\Exception\ExistingEmailException;
use Kata\RegistrationSystem\PasswordHelper;
use Kata\RegistrationSystem\RegistrationManager;
use Kata\RegistrationSystem\Storage;
use Kata\RegistrationSystem\Validator;
use Kata\RegistrationSystem\Entity\User;

class RegistrationManagerTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var RegistrationManager
     */
    private $registrationManager;

    /**
     * @var \PDO
     */
    private $PDO;

    /**
     * @var PasswordHelper
     */
    private $passwordHelper;

    const DB_SCHEMA = "
        CREATE TABLE users (
          id INTEGER AUTO_INCREMENT PRIMARY KEY,
          email varchar(256) default '',
          password text default '',
          salt text default ''
        )
    ";

    /**
     * Setup
     */
    protected function setUp() {
        $this->PDO = new \PDO('sqlite::memory:');
        $this->PDO->query(self::DB_SCHEMA);
        $validator = new Validator();
        $passwordHelper = new PasswordHelper();
        $storage = new Storage($this->PDO);
        $this->registrationManager = new RegistrationManager($validator, $passwordHelper, $storage);
        $this->passwordHelper = new PasswordHelper;
    }

    /**
     * Testing API regi
     *
     * @todo test password and salt generation and persistency to sql
     */
    public function testApiRegistration() {
        $email = 'teszt1@example.com';

        $this->assertTrue($this->registrationManager->apiRegistration($email));

        $this->assertEquals(1, count($this->PDO->query(sprintf("SELECT id FROM users WHERE email='%s'", $email))->fetchAll()));
    }

    /**
     * @todo test password and salt generation and persistency to sql
     */
    public function testFormRegistration()
    {
        $email = 'teszt1@example.com';
        $length = 33;

        $plainPassword = $this->passwordHelper->generateRandomString($length);

        $this->assertTrue($this->registrationManager->formRegistration($email, $plainPassword));
        $this->assertEquals(1, count($this->PDO->query(sprintf("SELECT id FROM users WHERE email='%s'", $email))->fetchAll()));
    }

    /**
     * @expectedException Kata\RegistrationSystem\Exception\ExistingEmailException
     */
    public function testExistingUserOnApi() {
        $email = 'teszt1@example.com';

        $this->PDO->query(sprintf("INSERT INTO users (email) values ('%s')", $email));
        $this->registrationManager->apiRegistration($email);
    }

    /**
     * @expectedException Kata\RegistrationSystem\Exception\ExistingEmailException
     */
    public function testExistingUserOnForm() {
        $email = 'teszt1@example.com';

        $this->PDO->query(sprintf("INSERT INTO users (email) values ('%s')", $email));
        $this->registrationManager->formRegistration($email, 'thisIsPlainTest123');
    }

    /**
     * @expectedException Kata\RegistrationSystem\Exception\InvalidPasswordException
     * @todo use constants of min and max length
     */
    public function testTooShortPassword() {
        $email = 'teszt1@example.com';
        $this->registrationManager->formRegistration($email, 'short');
    }


    /**
     * @expectedException Kata\RegistrationSystem\Exception\InvalidPasswordException
     */
    public function testTooLongPassword() {
        $email = 'teszt1@example.com';
        $password = str_pad('TestLongPass', 66, '0', STR_PAD_BOTH);
        $this->registrationManager->formRegistration($email, $password);
    }

    /**
     * @param $invalidEmail
     * @dataProvider invalidEmailProvider
     * @expectedException Kata\RegistrationSystem\Exception\InvalidEmailException
     */
    public function testInvalidEmailOnForm($invalidEmail) {
        $this->registrationManager->formRegistration($invalidEmail, 'ThisIsTestVAlidPlain1');
    }

    /**
     * @param $invalidEmail
     * @dataProvider invalidEmailProvider
     * @expectedException Kata\RegistrationSystem\Exception\InvalidEmailException
     */
    public function testInvalidEmailOnApi($invalidEmail) {
        $this->registrationManager->apiRegistration($invalidEmail);
    }

    public function invalidEmailProvider() {
        return array(
            array('asd'),
            array('@email.com'),
        );
    }

}
 