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

    public function isValidPassword($password) {
        if (!is_string($password)) {
            throw new \InvalidArgumentException;
        }
        if (strlen($password) < 6) {
            return false;
        }
        if (strlen($password)) > 64) {
            return false;
        }
        return true;
    }
} 