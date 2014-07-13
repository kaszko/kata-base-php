<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/12/2014
 * Time: 11:39 PM
 */

namespace Kata\Kata03;

use Kata\Kata03\Counter;
use Kata\Kata03\Validator;

/**
 * Class TimerCounter
 *
 * We are extending Counter with some timeout functionality.
 *
 *
 * @package Kata\Kata03
 */
class TimerCounter extends Counter {

    private $_timeOut = 1;
    private $_timeBlockSize = 1;

    /**
     * @var array
     */
    private $_timeBlocksCounters = array();

    /**
     * @param $timeBlockSize
     * @throws \Exception
     *
     * @todo refactor to Validator class
     */
    public function setTimeBlockSize($timeBlockSize) {
        Validator::validateMinimumValue($timeBlockSize, 1, 'time block size');
//        if (!is_numeric($timeBlockSize)) {
//            throw new \Exception('Time block size can by only number!');
//        }
//        if ($timeBlockSize < 1) {
//            throw new \Exception('Time block size must be at least 1!');
//        }
        $this->_timeBlockSize = (int) $timeBlockSize;
    }

    public function setTimeOut($timeOut) {
        Validator::validateMinimumValue($timeOut, 1, 'timeout');
//        if (!is_numeric($timeOut)) {
//            throw new \Exception('Timeout can by only number!');
//        }
//        if ($timeOut < 1) {
//            throw new \Exception('Timeout must be at least 1!');
//        }
        $this->_timeOut = $timeOut;
    }

    public function increase() {
        $timeBlockKey = $this->_getTimeBlockKeyForUnixTime(time());
        if (!isset($this->_timeBlocksCounters[$timeBlockKey])) {
            /**
             * Maybe there is no point to make new Counter :)
             */
            $this->_timeBlocksCounters[$timeBlockKey] = new Counter();
        }
        $this->_timeBlocksCounters[$timeBlockKey]->increase();
    }

    public function getCount() {
        $count = 0;
        foreach ($this->_timeBlocksCounters as $timeBlockKey => $counter) {
            if ($timeBlockKey >= time() - $this->_timeOut) {
                $count += $counter->getCount();
            }
            else {
                // some gc
                unset($this->_timeBlocksCounters[$timeBlockKey]);
            }
        }
        return $count;
    }

    private function _getTimeBlockKeyForUnixTime($unixtime) {
        return $unixtime - ($unixtime % $this->_timeBlockSize);
    }

} 