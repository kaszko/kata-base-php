<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/14/2014
 * Time: 11:48 PM
 */

namespace Kata\Kata03;


class Helper {
    public static function getRangeFromIp($ip) {
        list($a, $b, $c, $d) = explode(".", $ip);
        return $a . '.' . $b . '.' . $c;

    }
    public static function getTimeBlockKeyFromUnixtime($unixtime, $timeBlockSize) {
        return $unixtime - ($unixtime % $timeBlockSize);
    }
} 