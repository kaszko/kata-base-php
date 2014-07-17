<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/17/2014
 * Time: 9:32 PM
 */

namespace Kata\Test\Homework03;

use Kata\Homework03\PermutationHelper;

class PermutationHelperTest extends \PHPUnit_Framework_TestCase
{


    public function testGenerateBases()
    {

        $this->assertEquals(
            array(),
            PermutationHelper::generateBases('')
        );

        $this->assertEquals(
            array(
                'a' => '',
            ),
            PermutationHelper::generateBases('a')
        );

        $this->assertEquals(
            array(
                'a' => 'b',
                'b' => 'a',
            ),
            PermutationHelper::generateBases('ab')
        );

        $this->assertEquals(
            array(
                'a' => 'bc',
                'b' => 'ac',
                'c' => 'ab',
            ),
            PermutationHelper::generateBases('abc')
        );

    }


}
 