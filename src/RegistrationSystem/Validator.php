<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/30/2014
 * Time: 7:04 PM
 */

namespace Kata\RegistrationSystem;


use Kata\RegistrationSystem\Exception\NotStringException;

class Validator
{

    const MIN_PLAIN_PASS_LEN = 6;
    const MAX_PLAIN_PASS_LEN = 64;

    /**
     * @param $email
     * @return bool
     * @throws Exception\NotStringException
     */
    public function isValidEmail($email)
    {
        if (!is_string($email)) {
            return false;
        }

        if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    public function isValidPlainPassword($plainPassword)
    {
        if (!is_string($plainPassword)) {
            return false;
        }
        if (strlen($plainPassword) < self::MIN_PLAIN_PASS_LEN) {
            return false;
        }
        if (strlen($plainPassword) > self::MAX_PLAIN_PASS_LEN) {
            return false;
        }
        return true;
    }
} 