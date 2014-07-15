<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/12/2014
 * Time: 11:23 PM
 */

namespace Kata\Kata03;

class Counter {
    private $_count = 0;

    public function increase($increaseBy = 1) {
        $this->_count += (int) $increaseBy;
    }

    public function getCount() {
        return $this->_count;
    }
} 