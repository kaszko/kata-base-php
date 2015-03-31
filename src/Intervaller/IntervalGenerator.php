<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 3/31/2015
 * Time: 9:55 PM
 */

namespace Kata\Intervaller;


class IntervalGenerator {
    private $intervals;

    public function __construct()
    {
        $this->intervals = array();
    }

    public function add($number)
    {
        /** @var Interval $interval */
        foreach ($this->intervals as $interval)
        {
            $addResult = $interval->add($number);
            if ($addResult === true)
            {
                return true;
            }
        }
        $this->intervals[] = new Interval($number);
        return true;
    }

    public function getIntervals()
    {
        return $this->intervals;
    }
}