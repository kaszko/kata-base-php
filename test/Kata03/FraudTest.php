<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/15/2014
 * Time: 6:10 PM
 */

namespace Kata\Test\Kata03;

use Kata\Kata03\Fraud;

class FraudTest extends \PHPUnit_Framework_TestCase {
    public function testIpToomuch() {

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
}
 