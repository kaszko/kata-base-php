<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/12/2014
 * Time: 11:08 PM
 */

namespace Kata\Kata03;

use Kata\Kata03\TimerCounter;
use Kata\Kata03\Helper;

class LoginDb {
    private $_ipCounter = null;
    private $_rangeCounter = null;
    private $_countryCounter = null;



    public function setEnvIpAndCountry($ip, $country) {
        $range = Helper::getRangeFromIp($ip);
        $this->_ipCounter = CounterRegistry::getCounterFor('ip', $ip);
        $this->_countryCounter = CounterRegistry::getCounterFor('country', $country);
        $this->_rangeCounter = CounterRegistry::getCounterFor('range', $range);
    }

    public function logFailedLoginOfUserWithRegistrationCountry($username, $registrationCountry) {
        $this->_ipCounter->increase();
        $this->_rangeCounter->increase();
        $this->_countryCounter->increase();
    }

    public function getIpFailedLoginCount() {
        $this->_ipCounter->getCount();
    }

    public function getRangeFailedLoginCount() {
        $this->_rangeCounter->getCount();
    }

    public function getCountryFailedLoginCount() {
        $this->_countryCounter->getCount();
    }


}