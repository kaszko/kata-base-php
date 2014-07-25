<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/25/2014
 * Time: 10:32 AM
 */

namespace Kata\Test\Bergmann\GradeManager;

use Kata\Bergmann\GradeManager\TrainingAttendee;
use Kata\Bergmann\GradeManager\TrainingAttendeePrintData;

class TrainingAttendeeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $attendee;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $trainingAttendee;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $uniqueIdHelper;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $grade;

    protected function setUp() {
        $this->uniqueIdHelper = $this->getMock('Kata\\Bergmann\\GradeManager\\UniqueIdHelper');
        $this->attendee = $this->getMock('Kata\\Bergmann\\GradeManager\\Attendee', array(), array('Peter Pan Test', $this->uniqueIdHelper));
        $this->trainingAttendee = new TrainingAttendee($this->attendee);

        $this->grade = $this->getMock('Kata\\Bergmann\\GradeManager\\Grade', array(), array('999'));
    }

    public function testGetAttendee() {
        $this->assertEquals($this->attendee, $this->trainingAttendee->getAttendee());
    }

    public function testSetAndGetGrade() {
        $this->trainingAttendee->setGrade($this->grade);
        $this->assertEquals($this->grade, $this->trainingAttendee->getGrade());
    }

    public function testGetPrintDataWithoutGrade() {

        $this->attendee->expects($this->once())->method('getUniqueId')->will($this->returnValue(1));
        $this->attendee->expects($this->once())->method('getName')->will($this->returnValue('Peter Pan Test'));

        $expected = new TrainingAttendeePrintData;
        $expected->attendeeName = 'Peter Pan Test';
        $expected->attendeeUniqueId = 1;
        $expected->gradeValue = '';

        $this->assertEquals($expected, $this->trainingAttendee->getPrintData());
    }

    public function testGetPrintDataWithGrade() {

        $this->trainingAttendee->setGrade($this->grade);

        $this->attendee->expects($this->once())->method('getUniqueId')->will($this->returnValue(1));
        $this->attendee->expects($this->once())->method('getName')->will($this->returnValue('Peter Pan Test'));
        $this->grade->expects($this->once())->method('getGrade')->will($this->returnValue(999));

        $expected = new TrainingAttendeePrintData;
        $expected->attendeeName = 'Peter Pan Test';
        $expected->attendeeUniqueId = 1;
        $expected->gradeValue = 999;

        $this->assertEquals($expected, $this->trainingAttendee->getPrintData());


    }
}
 