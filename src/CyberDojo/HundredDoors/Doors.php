<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/16/2014
 * Time: 5:26 PM
 */


namespace Kata\CyberDojo\HundredDoors;

class Doors {

    private $doors = array();


    const STATUS_OPENED = 1;
    const STATUS_CLOSED = 2;


    public function __construct($count = 100) {
        for ($x = 1; $x <= $count; $x++) {
            $this->doors[$x] = self::STATUS_CLOSED;
        }
    }

    public function getOpenedDoors() {
        return $this->getDoorsIndexesByStatus(self::STATUS_OPENED);
    }

    public function toggleDoor($index) {
        $this->doors[$index] = $this->doors[$index] == self::STATUS_CLOSED ? self::STATUS_OPENED : self::STATUS_CLOSED;
    }

    private function getDoorsIndexesByStatus($expectedStatus) {
        $result = array();
        foreach ($this->doors as $index => $opened) {
            if ($opened == $expectedStatus) {
                $result[] = $index;
            }
        }
        return $result;
    }

    public function getCount()
    {
        return count($this->doors);
    }
} 