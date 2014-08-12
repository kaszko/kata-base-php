<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 8/12/2014
 * Time: 5:28 PM
 */

namespace Kata\Test\RegistrationSystem;


use Kata\RegistrationSystem\PasswordHelper;
use Kata\RegistrationSystem\RegistrationManager;
use Kata\RegistrationSystem\Storage;
use Kata\RegistrationSystem\Validator;

class RegistrationManagerTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var RegistrationManager
     */
    private $registrationManager;

    /**
     * @var \PDO
     */
    private $PDO;

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
    }

    public function testApiRegistration() {
        $email = 'teszt1@example.com';

        $this->assertTrue($this->registrationManager->apiRegistration($email));

        $this->assertEquals(1, count($this->PDO->query(sprintf("SELECT id FROM users WHERE email='%s'", $email))->fetchAll()));
    }
}
 