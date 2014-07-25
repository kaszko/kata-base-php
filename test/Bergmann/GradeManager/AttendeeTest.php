<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/25/2014
 * Time: 9:59 AM
 */

namespace Kata\Test\Bergmann\GradeManager;

use Kata\Bergmann\GradeManager\Attendee;

/**
 * Class AttendeeTest
 * @package Kata\Test\Bergmann\GradeManager
 *
 * @todo create Attendee Factory
 */
class AttendeeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $uniqueIdHelper;

    protected function setUp() {
        $this->uniqueIdHelper = $this->getMock('Kata\\Bergmann\\GradeManager\\UniqueIdHelper');
    }

    public function testGetName()
    {
        $attendee = new Attendee('attendeeName', $this->uniqueIdHelper);
        $this->assertEquals('attendeeName', $attendee->getName());
    }

    public function testGetUniqueId()
    {
        $this->uniqueIdHelper->expects($this->once())->method('get')->will($this->returnValue(100));
        $attendee = new Attendee('Kis Pista', $this->uniqueIdHelper);
        $this->assertEquals(100, $attendee->getUniqueId());
    }
}
 