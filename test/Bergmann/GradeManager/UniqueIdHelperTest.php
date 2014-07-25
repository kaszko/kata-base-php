<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/25/2014
 * Time: 10:12 AM
 */

namespace Kata\Test\Bergmann\GradeManager;

use Kata\Bergmann\GradeManager\UniqueIdHelper;

class UniqueIdHelperTest extends \PHPUnit_Framework_TestCase
{
    public function testUnique()
    {
        $uniqueIdHelper = new UniqueIdHelper();
        $this->assertNotEquals($uniqueIdHelper->get(), $uniqueIdHelper->get());
    }
}
 