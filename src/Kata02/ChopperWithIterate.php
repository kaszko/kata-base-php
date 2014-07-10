<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/9/2014
 * Time: 6:57 PM
 */

namespace Kata\Kata02;


class ChopperWithIterate {

    private $array;
    private $firstIndex = 0;
    private $lastIndex = 0;

    public function __construct(array $array) {
        $this->lastIndex = count($array) - 1;
        $this->array = $array;
    }

    public function getIndexOfValue($value) {
        $middleIndex = $this->getMiddleIndex();
        if ($this->array[$middleIndex] == $value) return $middleIndex;

        return -1;
    }

    public function getMiddleIndex() {
        return (int) floor(($this->firstIndex + $this->lastIndex)/2);
    }


} 