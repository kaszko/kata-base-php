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

    protected function setUp() {
        $this->PDO = new \PDO('sqlite::memory:');
        $this->PDO->query(self::DB_SCHEMA);
        $validator = new Validator();
        $passwordHelper = new PasswordHelper();
        $storage = new Storage($this->PDO);
        $this->registrationManager = new RegistrationManager($validator, $passwordHelper, $storage);
        $this->passwordHelper = new PasswordHelper;
    }

    public function testApiRegistration() {
        $email = 'teszt1@example.com';

        $user = new User();
        $user->email = $email;

        $this->assertTrue($this->registrationManager->apiRegistration($email));

        $this->assertEquals(1, count($this->PDO->query(sprintf("SELECT id FROM users WHERE email='%s'", $email))->fetchAll()));
    }

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
     * @expectedException \InvalidArgumentException
     */
    public function testTooShortPassword() {
        $email = 'teszt1@example.com';
        $this->registrationManager->formRegistration($email, 'short1');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function xtestTooLongPassword() {
        $email = 'teszt1@example.com';
        $this->registrationManager->formRegistration($email, str_pad('LongPass', 65, '0', STR_PAD_BOTH));
    }
}
 