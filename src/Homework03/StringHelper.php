<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/20/2014
 * Time: 10:27 PM *
 */

namespace Kata\Homework03;


class StringHelper {
    public function isPalindrom($string) {
        for ($x=0; $x<strlen($string); $x++) {
            $mirrorX = self::mirrorPosition($string, $x);
            if (substr($string, $x, 1) != substr($string, $mirrorX, 1)) {
                return false;
            }
        }
        return true;
    }

    public function mirrorPosition($string, $position) {
        if (strlen($string) == 0) return 0;
        return strlen($string) - $position - 1;
        //return 0;
    }
} 