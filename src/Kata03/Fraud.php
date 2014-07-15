<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/15/2014
 * Time: 6:15 PM
 */

namespace Kata\Kata03;

use Kata\Kata03\LoginDb;

class Fraud {

    private $ipLimit = 3;
    private $ipRangeLimit = 500;
    private $countryLimit = 1000;
    private $usernameLimit = 3;

    private $country = '';

    /**
     * @var LoginDb
     */
    private $loginDb;

    public function setLoginDb(LoginDb $loginDb) {
        $this->loginDb = $loginDb;
    }

    public function showCaptcha($lastLoginUsername = '') {
        if ($this->loginDb->getIpFailedLoginCount() >= $this->ipLimit) {
            return true;
        }
        if ($this->loginDb->getRangeFailedLoginCount() >= $this->ipRangeLimit) {
            return true;
        }
        if ($this->loginDb->getCountryFailedLoginCount() >= $this->countryLimit) {
            return true;
        }
        if ($this->loginDb->getUsernameFailedLoginCount() >= $this->usernameLimit) {
            return true;
        }
        return false;
    }

    public function getIpLimit() {
        return $this->ipLimit;
    }

    public function logFailedLoginOfUserWithRegistrationCountry($username, $regCountry) {
        if ($this->country != '' && $this->country != $regCountry) {
            // implement setting to limit, we need a new func and a new test
            $this->loginDb->increaseIpCounterBy($this->ipLimit);
        }
        else {
            $this->loginDb->logFailedLoginOfUserWithRegistrationCountry($username, $regCountry);
        }
    }

    public function setEnvIpCountryAndLastUser($ip, $country, $username) {
        $this->loginDb->setEnvIpCountryAndLastUser($ip, $country, $username);
        $this->country = $country;
    }

} 