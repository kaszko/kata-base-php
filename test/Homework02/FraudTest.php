<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/15/2014
 * Time: 5:33 PM
 */

use Kata\Homework02\LoginDataObject;

class FraudTest extends PHPUnit_Framework_TestCase {

    public function setup() {

    }

    public function testForValidInputs() {

    }

    private function createLoginData() {
        $loginDo = new LoginDataObject();
        $loginDo->ip = "192.168.1.1";
        $loginDo->ipRange = \Kata\Homework02\IpHelper::getIpRange($ip);
        $loginDo->ipCountry = \Kata\Homework02\IpHelper::getCountryCode($ip);
        $loginDo->userCountry = "hu";
        $loginDo->username = "user001";
    }
}
 