<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/25/2014
 * Time: 11:01 AM
 */

namespace Kata\Test\Bergmann\GradeManager;


use Kata\Bergmann\GradeManager\Training;
use Kata\Bergmann\GradeManager\TrainingAttendeePrintData;

class TrainingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Training
     */
    private $training;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $attendee;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $uniqueIdHelper;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $grade;

    public function setUp()
    {
        $this->uniqueIdHelper = $this->getMock('Kata\\Bergmann\\GradeManager\\UniqueIdHelper');
        $this->training = new Training('title');
        $this->attendee = $this->getMock('Kata\\Bergmann\\GradeManager\\Attendee', array(), array('Peter Pan Test', $this->uniqueIdHelper));
        $this->grade = $this->getMock('Kata\\Bergmann\\GradeManager\\Grade', array(), array('999'));

    }

    public function testGetTitle()
    {
        $this->assertEquals('title', $this->training->getTitle());
    }

    public function testGradeByAttendeeUniqueId()
    {
        $this->attendee->expects($this->once())
            ->method('getUniqueId')
            ->will($this->returnValue(10));

        $this->training->assignAttendee($this->attendee);
        $this->training->assignGradeToAttendeeByUniqueId(10, $this->grade);
        $this->assertEquals($this->grade, $this->training->getGradeByAttendeeUniqueId(10));
    }

    public function testGetListOfAttendeesWithGrades()
    {

        $this->attendee->expects($this->any())
            ->method('getUniqueId')
            ->will($this->returnValue(10));

        $this->attendee->expects($this->once())
            ->method('getName')
            ->will($this->returnValue('Peter Pan Test'));

        $this->grade->expects($this->once())
            ->method('getGrade')
            ->will($this->returnValue(999));

        $expected = array();
        $expected[0] = new TrainingAttendeePrintData;
        $expected[0]->attendeeName = 'Peter Pan Test';
        $expected[0]->attendeeUniqueId = 10;
        $expected[0]->gradeValue = 999;


        $this->training->assignAttendee($this->attendee);
        $this->training->assignGradeToAttendeeByUniqueId(10, $this->grade);
        $this->assertEquals($expected, $this->training->getListOfAttendeesWithGrades());
    }

    public function testAttendeeAlreadyAssignedToTraining() {

    }

    public function testAttendeeNotFoundWhenSettingGrade() {

    }

    public function testCanNotAssignMoreAttendeeToTraining() {

    }




}
 