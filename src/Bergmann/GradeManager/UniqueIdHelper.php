<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/25/2014
 * Time: 10:18 AM
 */

namespace Kata\Bergmann\GradeManager;


class UniqueIdHelper
{
    private $sequence = 0;

    public function get()
    {
        return ++$this->sequence;
    }
} 