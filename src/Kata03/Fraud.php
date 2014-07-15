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
    /**
     * @var Kata\Kata03\LoginDb
     */
    private $loginDb;

    public function setLoginDb(LoginDb $loginDb) {
        $this->loginDb = $loginDb;
    }

    public function showCaptcha() {
        if ($this->loginDb->getIpFailedLoginCount() >= 3) {
            return true;
        }
        return false;
    }

} 