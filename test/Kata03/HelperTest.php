<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/14/2014
 * Time: 11:43 PM
 */

namespace Kata\Test\Kata03;

use Kata\Kata03\Helper;


class HelperTest extends \PHPUnit_Framework_TestCase {
    public function testGetRangeFromIp() {
        $this->assertEquals('10.0.0', Helper::getRangeFromIp('10.0.0.5'));
        $this->assertEquals('192.168.1', Helper::getRangeFromIp('192.168.1.2'));
        $this->assertEquals('77.254.12', Helper::getRangeFromIp('77.254.12.11'));
    }

    public function testGetTimeBlockKeyFromUnixtime() {
        $this->assertEquals(10, Helper::getTimeBlockKeyFromUnixtime(12, 5));
        $this->assertEquals(40, Helper::getTimeBlockKeyFromUnixtime(44, 20));
        $this->assertEquals(80, Helper::getTimeBlockKeyFromUnixtime(98, 20));
    }
}
 