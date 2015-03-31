<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 3/31/2015
 * Time: 9:42 PM
 */

namespace Kata\Intervaller;

class Interval
{
    private $min;
    private $max;

    public function __construct($min, $max = null)
    {
        $this->min = $min;
        $this->max = $max !== null ? $max : $min;
    }

    public function add($number)
    {
        if ($number == $this->max + 1)
        {
            $this->max = $number;
            return true;
        }

        if ($number == $this->min - 1)
        {
            $this->min = $number;
            return true;
        }

        if ($number >= $this->min && $number <= $this->max)
        {
            return true;
        }
        return false;
    }
}