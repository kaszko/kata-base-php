<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/15/2014
 * Time: 5:28 PM
 */

namespace Kata\Homework02;


class IpHelper {
    public static function getCountryCode($ip) {
        return "hu";

    }
    public static function getIpRange($ip) {
        list($a, $b, $c, $d) = explode(".", $ip);
        return $a . '.' . $b . '.' . $c;
    }
}

