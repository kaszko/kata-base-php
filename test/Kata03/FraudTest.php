<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/15/2014
 * Time: 6:10 PM
 */

namespace Kata\Test\Kata03;

use Kata\Kata03\Fraud;
use Kata\Kata03\LoginDb;
use Kata\Kata03\CounterRegistry;

class FraudTest extends \PHPUnit_Framework_TestCase {

//    public function testIpTooMuch() {
//
//        $mockedLoginDb = $this->getMock('\\Kata\\Kata03\\LoginDb');
//        $mockedLoginDb->expects($this->any())
//            ->method('getIpFailedLoginCount')
//            ->will($this->returnValue(1));
//
//        $fraud = new Fraud();
//        $fraud->setLoginDb($mockedLoginDb);
//        $this->assertEquals(false, $fraud->showCaptcha());
//
//        $mockedLoginDb = $this->getMock('\\Kata\\Kata03\\LoginDb');
//        $mockedLoginDb->expects($this->any())
//            ->method('getIpFailedLoginCount')
//            ->will($this->returnValue(5));
//
//        $fraud = new Fraud();
//        $fraud->setLoginDb($mockedLoginDb);
//        $this->assertEquals(true, $fraud->showCaptcha());
//    }
//
//    public function testIpRangeTooMuch() {
//        $mockedLoginDb = $this->getMock('\\Kata\\Kata03\\LoginDb');
//        $mockedLoginDb->expects($this->any())
//            ->method('getRangeFailedLoginCount')
//            ->will($this->returnValue(499));
//
//        $fraud = new Fraud();
//        $fraud->setLoginDb($mockedLoginDb);
//        $this->assertEquals(false, $fraud->showCaptcha());
//
//        $mockedLoginDb = $this->getMock('\\Kata\\Kata03\\LoginDb');
//        $mockedLoginDb->expects($this->any())
//            ->method('getRangeFailedLoginCount')
//            ->will($this->returnValue(501));
//
//        $fraud = new Fraud();
//        $fraud->setLoginDb($mockedLoginDb);
//        $this->assertEquals(true, $fraud->showCaptcha());
//    }
//
//    public function testCountryTooMuch() {
//        $mockedLoginDb = $this->getMock('\\Kata\\Kata03\\LoginDb');
//        $mockedLoginDb->expects($this->any())
//            ->method('getCountryFailedLoginCount')
//            ->will($this->returnValue(999));
//
//        $fraud = new Fraud();
//        $fraud->setLoginDb($mockedLoginDb);
//        $this->assertEquals(false, $fraud->showCaptcha());
//
//        $mockedLoginDb = $this->getMock('\\Kata\\Kata03\\LoginDb');
//        $mockedLoginDb->expects($this->any())
//            ->method('getCountryFailedLoginCount')
//            ->will($this->returnValue(1001));
//
//        $fraud = new Fraud();
//        $fraud->setLoginDb($mockedLoginDb);
//        $this->assertEquals(true, $fraud->showCaptcha());
//    }
//
//    public function testUserTooMuch() {
//        $mockedLoginDb = $this->getMock('\\Kata\\Kata03\\LoginDb');
//        $mockedLoginDb->expects($this->any())
//            ->method('getUsernameFailedLoginCount')
//            ->will($this->returnValue(2));
//
//        $fraud = new Fraud();
//        $fraud->setLoginDb($mockedLoginDb);
//        $this->assertEquals(false, $fraud->showCaptcha());
//
//        $mockedLoginDb = $this->getMock('\\Kata\\Kata03\\LoginDb');
//        $mockedLoginDb->expects($this->any())
//            ->method('getUsernameFailedLoginCount')
//            ->will($this->returnValue(4));
//
//        $fraud = new Fraud();
//        $fraud->setLoginDb($mockedLoginDb);
//        $this->assertEquals(true, $fraud->showCaptcha());
//    }

    /**
     * @param $functionName
     * @param $underLimit
     * @param $aboveLimit
     * @dataProvider tooMuchDataProvider
     */
    public function testTooMuchData($functionName, $underLimit, $aboveLimit) {
        $mockedLoginDb = $this->getMock('\\Kata\\Kata03\\LoginDb');
        $mockedLoginDb->expects($this->any())
            ->method($functionName)
            ->will($this->returnValue($underLimit));

        $fraud = new Fraud();
        $fraud->setLoginDb($mockedLoginDb);
        $this->assertEquals(false, $fraud->showCaptcha());

        $mockedLoginDb = $this->getMock('\\Kata\\Kata03\\LoginDb');
        $mockedLoginDb->expects($this->any())
            ->method($functionName)
            ->will($this->returnValue($aboveLimit));

        $fraud = new Fraud();
        $fraud->setLoginDb($mockedLoginDb);
        $this->assertEquals(true, $fraud->showCaptcha());
    }



    public function tooMuchDataProvider() {
        return array(
            array('getCountryFailedLoginCount', 999, 1001),
            array('getRangeFailedLoginCount', 499, 501),
            array('getUsernameFailedLoginCount', 2, 4),
            array('getIpFailedLoginCount', 1, 5)
        );
    }



    public function testUserCountryDiff() {

        $ip ='192.168.1.1';
        $country = 'HU';
        $username = 'kolos';

        $fraud = new Fraud();

        $loginDb = new LoginDb();
        $fraud->setLoginDb($loginDb);

        $fraud->setEnvIpCountryAndLastUser($ip, $country, $username);


        $this->assertEquals(0, $loginDb->getIpFailedLoginCount());
        $this->assertEquals(0, $loginDb->getRangeFailedLoginCount());
        $this->assertEquals(0, $loginDb->getCountryFailedLoginCount());
        $this->assertEquals(0, $loginDb->getUsernameFailedLoginCount());

        $fraud->logFailedLoginOfUserWithRegistrationCountry('kolos', 'DE');

        $this->assertEquals($fraud->getIpLimit(), $loginDb->getIpFailedLoginCount());
        $this->assertEquals(true, $fraud->showCaptcha());
    }

    public function testOnlyIncreaseIpIfShowCaptcha() {

        $ip ='192.168.1.1';
        $country = 'DE';
        $username = 'kolos';

        $fraud = new Fraud();

        CounterRegistry::resetCounters(); // needs to reset

        $loginDb = new LoginDb();
        $fraud->setLoginDb($loginDb);

        $fraud->setEnvIpCountryAndLastUser($ip, $country, $username);

        $this->assertEquals(0, $loginDb->getIpFailedLoginCount());
        $this->assertEquals(0, $loginDb->getRangeFailedLoginCount());
        $this->assertEquals(0, $loginDb->getCountryFailedLoginCount());
        $this->assertEquals(0, $loginDb->getUsernameFailedLoginCount());

        $fraud->logFailedLoginOfUserWithRegistrationCountry('kolos', 'DE');
        $fraud->logFailedLoginOfUserWithRegistrationCountry('kolos', 'DE');
        $fraud->logFailedLoginOfUserWithRegistrationCountry('kolos', 'DE');

        $this->assertEquals(3, $loginDb->getIpFailedLoginCount());
        $this->assertEquals(3, $loginDb->getRangeFailedLoginCount());
        $this->assertEquals(3, $loginDb->getCountryFailedLoginCount());
        $this->assertEquals(3, $loginDb->getUsernameFailedLoginCount());

        $fraud->logFailedLoginOfUserWithRegistrationCountry('kolos', 'DE');

        // csak az ip novekszik
        $this->assertEquals(4, $loginDb->getIpFailedLoginCount());
        $this->assertEquals(3, $loginDb->getRangeFailedLoginCount());
        $this->assertEquals(3, $loginDb->getCountryFailedLoginCount());
        $this->assertEquals(3, $loginDb->getUsernameFailedLoginCount());


    }
}
 