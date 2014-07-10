<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/9/2014
 * Time: 5:34 PM
 */

namespace Kata\Kata02;

class Karate {

    /**
     * binary searching
     *
     * @param $number
     * @param array $array
     */
    public static function Chop($number, array $array) {
        return self::ChopIterate($number, $array);


/*        if (self::valueAtIndexMatches($number, $middleIdx, $array)) {
            return $middleIdx;
        }
        return -1;*/
    }

    public static function ChopIterate($number, array $array) {


       //$chopper = new ChopperWithIterate($number, $array);

        //if(empty($array)) return -1;

        $firstIdx = 0;
        $lastIdx = sizeof($array)-1;
        while ($firstIdx <= $lastIdx) {
            $middleIdx = self::getMiddleIdxOnMinMaxIdx($firstIdx, $lastIdx);
            if (self::valueAtIndexMatches($number, $middleIdx, $array)) {
                return $middleIdx;
            }

            if ($array[$middleIdx] > $number) {
                $lastIdx = $middleIdx-1;
            }
            else {
                $firstIdx = $middleIdx+1;
            }

        }


        return -1;
    }

    public static function getMiddleIdxOnMinMaxIdx($firstIdx, $lastIdx) {
        $middleIdx = (int)floor(($firstIdx+$lastIdx)/2);
        return $middleIdx;
    }

/*    public static function getMiddleIdxOfArray(array $array) {
        $middleIdx = (int)floor((count($array)-1)/2);
        return $middleIdx;
    }*/

    public static function valueAtIndexMatches($value, $idx, array $array) {
        if (!isset($array[$idx])) return false;
        return $value === $array[$idx];
    }
} 