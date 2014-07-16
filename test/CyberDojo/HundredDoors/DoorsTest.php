<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/16/2014
 * Time: 5:20 PM
 */

namespace Kata\Test\CyberDojo\HundredDoors;

use Kata\CyberDojo\HundredDoors\Doors;

class DoorsTest extends \PHPUnit_Framework_TestCase {
    public function testDoorsCount() {
        $doors = new Doors(50);
        $this->assertEquals(50, $doors->getCount());

        $doors = new Doors(12);
        $this->assertEquals(12, $doors->getCount());
    }

    public function testToggle() {
        $hundredDoors = new Doors();
        $this->assertCount(0, $hundredDoors->getOpenedDoors());

        $hundredDoors->toggleDoor(1);

        $this->assertEquals(array(1), $hundredDoors->getOpenedDoors());

        $hundredDoors->toggleDoor(1);
        $this->assertEquals(array(), $hundredDoors->getOpenedDoors());
    }


}
 