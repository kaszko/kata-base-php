<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/24/2014
 * Time: 11:12 AM
 */

namespace Kata\Bergman\RomainArabicConverter;


use SebastianBergmann\Exporter\Exception;

class Converter {
    public function convertToArabic($romain) {
        //return 1;

        $bufferValue = 0;
        $romainValue = 0;
        $charValue = 0; // int value of actual character
        $lastCharValue = 0;

        for ($x=0; $x<strlen($romain); $x++) {
            $actualChar = substr($romain, $x, 1);
            $charValue = $this->getCharIntValue($actualChar);

            if ($charValue == $lastCharValue || $lastCharValue == 0) {
                $bufferValue += $charValue;
            }
            else if ($charValue < $lastCharValue) {
                $romainValue += $bufferValue;
                $bufferValue = $charValue;
            }
            else if ($charValue > $lastCharValue) {
                if ($bufferValue != $lastCharValue) {
                    throw new \Exception('Invalid romain number!');
                }
                $bufferValue = $charValue - $bufferValue;
            }

            $lastCharValue = $charValue;

        }

        $romainValue += $bufferValue;

        return $romainValue;
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
        throw new \Exception('Invalid romain character/digit');
    }
} 