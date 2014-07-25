<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/25/2014
 * Time: 10:40 AM
 */

namespace Kata\Bergmann\GradeManager;

use Kata\Bergmann\GradeManager\Attendee;
use Kata\Bergmann\GradeManager\Grade;

class TrainingAttendee {
    private $attendee;
    private $grade;

    public function __construct(Attendee $attendee) {
        $this->attendee = $attendee;
    }

    public function getAttendee() {
        return $this->attendee;
    }

    public function setGrade(Grade $grade) {
        $this->grade = $grade;
    }

    public function getGrade() {
        return $this->grade;
    }

    public function getPrintData() {
        $printData = new TrainingAttendeePrintData;
        $printData->attendeeUniqueId = $this->attendee->getUniqueId();
        $printData->attendeeName = $this->attendee->getName();
        if ($this->grade instanceof Grade) {
            $printData->gradeValue = $this->grade->getGrade();
        }
        return $printData;
    }
} 