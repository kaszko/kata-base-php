<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/29/2014
 * Time: 6:47 PM
 */

namespace Kata\RegistrationSystem;

use Kata\RegistrationSystem\Entity\Password;

class PasswordHelper {

    private static $charSet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789+/*-#$@%<>()';

    public function generateRandomString($length) {
        $str = '';
        for ($x = 0; $x<$length; $x++) {

            $str .= substr(self::$charSet, (int)(mt_rand(1,99999) % strlen(self::$charSet)), 1);
        }
        return $str;
    }

    public function hashStringWithSalt($string, $salt) {
        return sha1($salt . $string . $salt);
    }

    public function generatePassword($plainPassword, $saltLength = 10) {
        $salt = $this->generateRandomString($saltLength);

        $passwordObject = new Password();
        $passwordObject->hashedPassword = $this->hashStringWithSalt($plainPassword, $salt);
        $passwordObject->salt = $salt;

        return $passwordObject;
    }

} 