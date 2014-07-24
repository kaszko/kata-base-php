<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/24/2014
 * Time: 9:15 AM
 */

namespace Kata\Bergman\Counter;

class Counter
{
    /**
     * @var integer
     */
    private $current = 0;

    /**
     * @var integer
     */
    private $increment = 1;

    public function next()
    {
        $this->current += $this->increment;

        return $this->current;
    }

    /**
     * @param  integer $increment
     * @throws InvalidArgumentException
     */
    public function setIncrement($increment)
    {
        if (!is_integer($increment)) {
            throw new \InvalidArgumentException;
        }

        $this->increment = $increment;
    }
}