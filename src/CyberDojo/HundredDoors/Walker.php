<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/16/2014
 * Time: 5:26 PM
 */


namespace Kata\CyberDojo\HundredDoors;

class Walker {
    protected $doors;

    public function setDoors(Doors $doors)
    {
        $this->doors = $doors;
    }

    public function walkOnEvery($onEvery = 1)
    {
//        $this->doors->getCount();
//        $this->doors->toggleDoor(0);
//        $this->doors->toggleDoor(1);
        $max = $this->doors->getCount();
        $indexesToToggle = ModHelper::doorsToToggle($onEvery, $max);
        foreach ($indexesToToggle as $index) {
            $this->doors->toggleDoor($index);
        }

    }

    public function walkThrough() {
        $max = $this->doors->getCount();
        for ($x = 0; $x<$max; $x++) {
            $this->walkOnEvery($x+1);
        }
    }
} 