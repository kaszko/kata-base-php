<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/24/2014
 * Time: 11:12 AM
 */

namespace Kata\Bergmann\RomanArabicConverter;


class Converter {
    public function convertToArabic($roman) {
        //return 1;

        $bufferValue = 0;
        $romanValue = 0;
        $charValue = 0; // int value of actual character
        $lastCharValue = 0;

        for ($x=0; $x<strlen($roman); $x++) {
            $actualChar = substr($roman, $x, 1);
            $charValue = $this->getCharIntValue($actualChar);

            if ($charValue == $lastCharValue || $lastCharValue == 0) {
                $bufferValue += $charValue;
            }
            else if ($charValue < $lastCharValue) {
                $romanValue += $bufferValue;
                $bufferValue = $charValue;
            }
            else if ($charValue > $lastCharValue) {
                // more than 1 lower value before
                if ($bufferValue != $lastCharValue) {
                    throw new \Exception('Invalid roman number!');
                }
                // too high lower value before
                if ($bufferValue >= $charValue / 2) {
                    throw new \Exception('Invalid roman number!');
                }
                $bufferValue = $charValue - $bufferValue;
            }

            $lastCharValue = $charValue;

        }

        $romanValue += $bufferValue;

        return $romanValue;
    }

    private function getCharIntValue($char) {
        if ($char == 'I') {
            return 1;
        }
        if ($char == 'V') {
            return 5;
        }
        if ($char == 'X') {
            return 10;
        }
        if ($char == 'L') {
            return 50;
        }
        if ($char == 'C') {
            return 100;
        }
        if ($char == 'D') {
            return 500;
        }
        if ($char == 'M') {
            return 1000;
        }
        throw new \Exception('Invalid roman character/digit');
    }
} 