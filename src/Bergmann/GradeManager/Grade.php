<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/25/2014
 * Time: 9:53 AM
 */

namespace Kata\Bergmann\GradeManager;


class Grade
{
    private $grade;

    public function __construct($grade)
    {
        if (!is_scalar($grade)) {
            throw new \InvalidArgumentException;
        }
        $this->grade = $grade;
    }

    public function getGrade()
    {
        return $this->grade;
    }
} 