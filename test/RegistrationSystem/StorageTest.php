<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 8/6/2014
 * Time: 5:54 PM
 */

namespace Kata\Test\RegistrationSystem;


use Kata\RegistrationSystem\PasswordHelper;
use Kata\RegistrationSystem\Entity\User;
use Kata\RegistrationSystem\Storage;

class StorageTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var \PDO
     */
    private $PDO;
    private $storage;

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
        echo "setup ok\n";
        $this->storage = new Storage($this->PDO);
    }

    public function testSaveUser() {
        $user = new User();
        $user->email = 'test@example.com';
        $user->password = (new PasswordHelper())->generatePassword('testPlainPassword');

        $this->assertTrue($this->storage->saveUser($user));


        $this->assertEquals(1, count($this->PDO->query("SELECT id FROM users WHERE email='test@example.com'")->fetchAll()));
    }

    public function testUserExistsByEmail() {
        $this->PDO->query("INSERT INTO users (email, password, salt) VALUES ('test@example2.com', '', '')");

        $this->assertTrue($this->storage->userExistsByEmail('test@example2.com'));
        $this->assertFalse($this->storage->userExistsByEmail('notinserted@example.com'));
    }


}
 