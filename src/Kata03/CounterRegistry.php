<?php
/**
 * Counter registry. We use this instead of database.
 *
 * User: kaszko
 * Date: 7/13/2014
 * Time: 11:28 AM
 */

namespace Kata\Kata03;

use Kata\Kata03\TimerCounter;

class CounterRegistry {

    const COUNTER_DEFAULT_TIMEOUT = 3600;
    const COUNTER_DEFAULT_TIMEBLOCKSIZE = 300;

    const DATATYPE_IP = 'ip';
    const DATATYPE_RANGE = 'range';
    const DATATYPE_COUNTRY = 'country';

    private static $_counters = array();

    public static function getCounterFor($dataType, $dataValue) {
        $hashKey = self::_createHashKey($dataType, $dataValue);
        if (!isset(self::$_counters[$hashKey])) {

            self::$_counters[$hashKey] = self::factoryCounter();
        }
        return self::$_counters[$hashKey];
    }

    public static function factoryCounter() {
        $counter = new TimerCounter();
        $counter->setTimeOut(self::COUNTER_DEFAULT_TIMEOUT);
        $counter->setTimeBlockSize(self::COUNTER_DEFAULT_TIMEBLOCKSIZE);
        return $counter;
    }

    public static function resetCounters() {
        self::$_counters = array();
    }


    /**
     * we trust in it
     *
     * @param $dataType
     * @param $dataValue
     * @return string
     */
    private static function _createHashKey($dataType, $dataValue) {
        return md5(serialize(array($dataType, $dataValue)));
    }
}
