<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/7/2014
 * Time: 8:24 PM
 */

namespace Kata\Kata01;


class Product {

    protected $type = '';
    protected $unitPrice = null;
    protected $unit = '';

    public function __construct($type, Money $unitPrice, $unit) {
        $this->type = $type;
        $this->unitPrice = $unitPrice;
        $this->unit = $unit;
    }

    public function getUnitPrice() {
        return $this->unitPrice;
    }

    public function getType() {
        return $this->type;
    }

    public function getUnit() {
        return $this->unit;
    }

}