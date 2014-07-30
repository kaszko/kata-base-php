<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/30/2014
 * Time: 7:04 PM
 */

namespace Kata\RegistrationSystem;


class Validator {



    public function isValidEmail($email) {
        if (!is_string($email)) {
            throw new \InvalidArgumentException;
        }

        if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    public function isValidPlainPassword($plainPassword) {
        if (!is_string($plainPassword)) {
            throw new \InvalidArgumentException;
        }
        if (strlen($plainPassword) < 6) {
            return false;
        }
        if (strlen($plainPassword)) > 64) {
            return false;
        }
        return true;
    }
} 