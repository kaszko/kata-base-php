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

class StorageTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var \PDO
     */
//    private $PDO;
//    private $storage;
//
//    const DB_SCHEMA = "
//        CREATE TABLE `users` (
//          `id` INTEGER AUTO_INCREMENT PRIMARY KEY,
//          `email` varchar(256) default '',
//          `password` text default '',
//          `salt` text default '',
//          KEY (`email`)
//        )
//    ";
//
//    protected function setUp() {
//        $this->PDO = new \PDO('sqlite::memory:');
//        $this->PDO->query(self::DB_SCHEMA);
//        echo "setup ok\n";
//        //$this->storage = new Storage($this->PDO);
//    }
//
//    public function testSaveUser() {
//        $user = new User();
//        $user->email = 'test@example.com';
//        $user->password = (new PasswordHelper())->generatePassword('testPlainPassword');
//
//       // $this->storage->saveUser($user);
//
//        $tmp = count($this->PDO->query("SELECT 1 as 'test' FROM users")->fetchAll());
//        var_export($tmp);
//        //$this->assertEquals(1, $this->PDO->query("SELECT id FROM users WHERE email='test@example.com'")->fetchAll());
//    }

    static private $pdo = null;

    const DB_SCHEMA = "

    ";

    private function getConnection()
    {
        if (self::$pdo == null) {
            self::$pdo = new \PDO('sqlite::memory:');
        }
        var_export(self::$pdo);
        return self::$pdo;
    }

    public function setUp() {
        try
        {
            $db = new \PDO('sqlite::memory:');
            echo "SQLite created in memory.";
            $db->exec('CREATE TABLE test (id INTEGER)');
            $x = $db->query("show tables");
            var_export($x->fetchAll());
            exit;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        exit;

        //$res->fetchAll();
        $x = $res->fetchAll();
        echo "setup\n";
        exit;
    }

    public function testValami() {

        var_export($x);
        echo 1;
    }
}
 