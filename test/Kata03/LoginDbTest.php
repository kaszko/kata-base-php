<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/12/2014
 * Time: 10:56 AM
 */

namespace Kata\Test\Kata03;

use Kata\Kata03\LoginDb;

class LoginDbTest extends \PHPUnit_Framework_TestCase {

    public function testSaveFailedLogin() {
        $ip ='192.168.1.1';
        $country = 'HU';
        $username = 'kolos';

        $loginDb = new LoginDb();
        $loginDb->setEnvIpAndCountry($ip, $country);

        $loginDb->logFailedLoginOfUserWithRegistrationCountry('kolos', 'HU');

        $this->assertEquals(1, $loginDb->getIpFailedLoginCount());
        $this->assertEquals(1, $loginDb->getRangeFailedLoginCount());
        $this->assertEquals(1, $loginDb->getCountryFailedLoginCount());

        $loginDb->logFailedLoginOfUserWithRegistrationCountry('kolos', 'HU');

        $this->assertEquals(2, $loginDb->getIpFailedLoginCount());
        $this->assertEquals(2, $loginDb->getRangeFailedLoginCount());
        $this->assertEquals(2, $loginDb->getCountryFailedLoginCount());



    }

/*    //  public function

    static private $pdo = null;

    const DB_SCHEMA = "
        CREATE TABLE failed_logins (
          id INTEGER AUTO_INCREMENT PRIMARY KEY,
          ip VARCHAR(16),
          country varchar(3),
          username varchar(256),
          unixtime integer default 0,
          KEY (ip),
          KEY (country),
          KEY (useraname),
          KEY (unixtime)
        )
    ";

    private function getConnection()
    {
        if (self::$pdo == null) {
            self::$pdo = new \PDO('sqlite::memory:');
        }
        return self::$pdo;
    }

    public function setUp() {
        $this->getConnection()->exec(self::DB_SCHEMA);
        echo "setup\n";
    }

    public function testValami() {
        $res = $this->getConnection()->prepare("select * from failed_logins");
        $res->execute();
        $x = $res->fetchAll();
        var_export($x);
        echo 1;
    }

//    public function testSaveFailedLogin() {
//        $ip ='192.168.1.1';
//        $country = 'HU';
//        $username = 'kolos';
//
//        $loginDb = new LoginDb;
//        $loginDb->setEnvIpAndCountry($ip, $country);
//        $loginDb->logFailedLoginOfUserWithRegistrationCountry('kolos', 'HU');
//
//        $this->assertEquals(1, $loginDb->getIpFailedLoginCount());
//        $this->assertEquals(1, $loginDb->getRangeFailedLoginCount());
//        $this->assertEquals(1, $loginDb->getCountryFailedLoginCount());
//    }

    public function testInvalidation() {

    }

    public function testGarbageCollection() {

    }

    public function tearDown() {
        echo "teardown\n";
        $this->getConnection()->exec("DELETE FROM failed_logins");
    }*/

}
 