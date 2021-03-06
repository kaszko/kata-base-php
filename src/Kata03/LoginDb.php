<?php
/**
 * Logindb to store login history.
 * Here we can implement data persist.
 *
 * User: kaszko
 * Date: 7/12/2014
 * Time: 11:08 PM
 */

namespace Kata\Kata03;

use Kata\Kata03\TimerCounter;
use Kata\Kata03\Helper;

class LoginDb {
    private $ipCounter = null;
    private $rangeCounter = null;
    private $countryCounter = null;
    private $userCounter = null;

    public function setEnvIpCountryAndLastUser($ip, $country, $lastusername) {
        $range = Helper::getRangeFromIp($ip);
        $this->ipCounter = CounterRegistry::getCounterFor('ip', $ip);
        $this->countryCounter = CounterRegistry::getCounterFor('country', $country);
        $this->rangeCounter = CounterRegistry::getCounterFor('range', $range);
        if ($lastusername != '') {
            $this->userCounter = CounterRegistry::getCounterFor('username', $lastusername);
        }
    }

    public function logFailedLoginOfUserWithRegistrationCountry($username, $registrationCountry) {
        $this->ipCounter->increase();
        $this->rangeCounter->increase();
        $this->countryCounter->increase();

        $usernameCounter = CounterRegistry::getCounterFor('username', $username);
        $usernameCounter->increase();
    }

    public function getIpFailedLoginCount() {
        return $this->ipCounter->getCount();
    }

    public function getRangeFailedLoginCount() {
        return $this->rangeCounter->getCount();
    }

    public function getCountryFailedLoginCount() {
        return $this->countryCounter->getCount();
    }
    public function getUsernameFailedLoginCount() {
        if ($this->userCounter !== null && $this->userCounter instanceof TimerCounter) {
            return $this->userCounter->getCount();
        }
        return 0;
    }

    public function increaseIpCounterBy($increaseBy) {
        $this->ipCounter->increase((int) $increaseBy);
    }

}