<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/25/2014
 * Time: 9:49 AM
 */

namespace Kata\Test\Bergmann\GradeManager;

use Kata\Bergmann\GradeManager\Grade;

class GradeTest extends \PHPUnit_Framework_TestCase
{
    public function testGetGrade()
    {
        $grade = new Grade(1);
        $this->assertEquals(1, $grade->getGrade());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGradeThrowsException()
    {
        $grade = new Grade(new \stdClass());
    }
}
 