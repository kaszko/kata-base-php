<?php
/**
 * Some validator helper.
 *
 * User: kaszko
 * Date: 7/13/2014
 * Time: 12:11 PM
 */

namespace Kata\Kata03;


class Validator {
    public static function validateNumber($number, $label = 'given number') {
        if (!is_numeric($number)) {
            throw new \Exception(sprintf("The % must be a valid number!", $label));
        }
        return true;
    }

    public static function validateMinimumValue($number, $minimumValue, $label = 'given number') {
        self::validateNumber($number);
        if ($number < $minimumValue) {
            throw new \Exception(sprintf("The % must be minimum %!", $label, $minimumValue));
        }
        return true;
    }
} 