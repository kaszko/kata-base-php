<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/8/2014
 * Time: 8:45 PM
 */

namespace Kata\Kata01;

class Money {
    const DECIMALS = 2;

    private $intValue = 0;

    public function __construct($value, $isIntValue = false) {

        if ($value<0) {
            throw new \Exception('Can not have negative value!');
        }

        if ($isIntValue) {
            $this->intValue = $value;
        }
        else {
            $this->intValue = bcmul($value, $this->getD());
        }
    }

    public function getValue() {
        return bcdiv($this->intValue, $this->getD(), self::DECIMALS);
    }

    public function addMoney(Money $money) {
        return new Money($this->intValue + $money->intValue, true);
    }

    public function subtractMoney(Money $money) {
        return new Money($this->intValue - $money->intValue, true);
    }

    private function getD() {
        return pow(10, self::DECIMALS);
    }
} 