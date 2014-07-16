<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/16/2014
 * Time: 10:40 PM
 */

namespace Kata\Test\CyberDojo\HundredDoors;

use Kata\CyberDojo\HundredDoors\ModHelper;

class ModHelperTest extends \PHPUnit_Framework_TestCase {
    public function testWhichDoorsToToggle() {

        $this->assertEquals(array(1,2,3,4,5), ModHelper::doorsToToggle(1, 5));
        $this->assertEquals(array(2,4), ModHelper::doorsToToggle(2, 5));
        $this->assertEquals(array(3), ModHelper::doorsToToggle(3, 5));

    }
}
 