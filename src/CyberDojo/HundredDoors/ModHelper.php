<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/16/2014
 * Time: 10:42 PM
 */

namespace Kata\CyberDojo\HundredDoors;


class ModHelper {
  public static function doorsToToggle($iterationIndex, $doorsCount) {
      $toToggle = array();
      for ($x=1; $x <= $doorsCount; $x++) {
          if (($x % $iterationIndex)==0) {
              $toToggle[] = $x;
          }
      }
      return $toToggle;
  }
} 