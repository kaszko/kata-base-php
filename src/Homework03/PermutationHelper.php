<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/17/2014
 * Time: 9:46 PM
 */

namespace Kata\Homework03;

class PermutationHelper {
    public static function generateBases($inputString) {
        $charsArray = str_split($inputString);
        $returnArray = array();
        foreach ($charsArray as $charIndex => $char) {
            if (!empty($char)) {
                $returnArray[$char] = substr($inputString, 0, $charIndex) . substr($inputString, $charIndex + 1);
            }
        }
        return $returnArray;
    }
} 