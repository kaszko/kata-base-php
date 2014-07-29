<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/25/2014
 * Time: 11:06 AM
 */

namespace Kata\Bergmann\GradeManager;

use Kata\Bergmann\GradeManager\TrainingAttendee;

class Training
{
    private $title;

    /**
     * @var TrainingAttendee[]
     */
    private $trainingAttendees = array();

    public function __construct($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function assignAttendee(Attendee $attendee)
    {
       $uniqueId = $attendee->getUniqueId();
       $this->trainingAttendees[$uniqueId] = new TrainingAttendee($attendee);
    }

    public function assignGradeToAttendeeByUniqueId($uniqueId, Grade $grade)
    {
        $this->trainingAttendees[$uniqueId]->setGrade($grade);
    }

    public function getGradeByAttendeeUniqueId($uniqueId)
    {
        return $this->trainingAttendees[$uniqueId]->getGrade();
    }

    public function getListOfAttendeesWithGrades() {
        $printList = array();
        foreach ($this->trainingAttendees as $trainingAttendee) {
            $printList[] = $trainingAttendee->getPrintData();
        }
        return $printList;
    }
} 