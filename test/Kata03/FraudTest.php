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

class FraudTest extends \PHPUnit_Framework_TestCase {

    public function testIpTooMuch() {

        $mockedLoginDb = $this->getMock('\\Kata\\Kata03\\LoginDb');
        $mockedLoginDb->expects($this->any())
            ->method('getIpFailedLoginCount')
            ->will($this->returnValue(1));

        $fraud = new Fraud();
        $fraud->setLoginDb($mockedLoginDb);
        $this->assertEquals(false, $fraud->showCaptcha());

        $mockedLoginDb = $this->getMock('\\Kata\\Kata03\\LoginDb');
        $mockedLoginDb->expects($this->any())
            ->method('getIpFailedLoginCount')
            ->will($this->returnValue(5));

        $fraud = new Fraud();
        $fraud->setLoginDb($mockedLoginDb);
        $this->assertEquals(true, $fraud->showCaptcha());
    }

    public function testIpRangeTooMuch() {
        $mockedLoginDb = $this->getMock('\\Kata\\Kata03\\LoginDb');
        $mockedLoginDb->expects($this->any())
            ->method('getRangeFailedLoginCount')
            ->will($this->returnValue(499));

        $fraud = new Fraud();
        $fraud->setLoginDb($mockedLoginDb);
        $this->assertEquals(false, $fraud->showCaptcha());

        $mockedLoginDb = $this->getMock('\\Kata\\Kata03\\LoginDb');
        $mockedLoginDb->expects($this->any())
            ->method('getRangeFailedLoginCount')
            ->will($this->returnValue(501));

        $fraud = new Fraud();
        $fraud->setLoginDb($mockedLoginDb);
        $this->assertEquals(true, $fraud->showCaptcha());
    }

    public function testCountryTooMuch() {
        $mockedLoginDb = $this->getMock('\\Kata\\Kata03\\LoginDb');
        $mockedLoginDb->expects($this->any())
            ->method('getCountryFailedLoginCount')
            ->will($this->returnValue(999));

        $fraud = new Fraud();
        $fraud->setLoginDb($mockedLoginDb);
        $this->assertEquals(false, $fraud->showCaptcha());

        $mockedLoginDb = $this->getMock('\\Kata\\Kata03\\LoginDb');
        $mockedLoginDb->expects($this->any())
            ->method('getCountryFailedLoginCount')
            ->will($this->returnValue(1001));

        $fraud = new Fraud();
        $fraud->setLoginDb($mockedLoginDb);
        $this->assertEquals(true, $fraud->showCaptcha());
    }

    public function testUserTooMuch() {
        $mockedLoginDb = $this->getMock('\\Kata\\Kata03\\LoginDb');
        $mockedLoginDb->expects($this->any())
            ->method('getUsernameFailedLoginCount')
            ->will($this->returnValue(2));

        $fraud = new Fraud();
        $fraud->setLoginDb($mockedLoginDb);
        $this->assertEquals(false, $fraud->showCaptcha());

        $mockedLoginDb = $this->getMock('\\Kata\\Kata03\\LoginDb');
        $mockedLoginDb->expects($this->any())
            ->method('getUsernameFailedLoginCount')
            ->will($this->returnValue(4));

        $fraud = new Fraud();
        $fraud->setLoginDb($mockedLoginDb);
        $this->assertEquals(true, $fraud->showCaptcha());
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
    }
}
 