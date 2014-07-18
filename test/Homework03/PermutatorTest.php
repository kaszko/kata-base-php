<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/17/2014
 * Time: 10:11 PM
 */

namespace Kata\Test\Homework03;

use Kata\Homework03\PermutationHelper;
use Kata\Homework03\Permutator;

class PermutatorTest extends \PHPUnit_Framework_TestCase {
    public function testGetPermutations() {
        $permutator = new Permutator();
        $permutator->setString('a');
        $this->assertEquals(
            array('a'),
            $permutator->getPermutations()
        );

        $permutator = new Permutator();
        $permutator->setString('ab');
        $this->assertEquals(
            array('ab', 'ba'),
            $permutator->getPermutations()
        );

        $permutator = new Permutator();
        $permutator->setString('abc');
        $this->assertEquals(
            array('abc', 'acb', 'bac', 'bca', 'cab', 'cba'),
            $permutator->getPermutations()
        );

        $permutator = new Permutator();
        $permutator->setString('biro');
        $expected = array('biro', 'bior', 'brio', 'broi', 'boir', 'bori',
            'ibro', 'ibor', 'irbo', 'irob', 'iobr', 'iorb',
            'rbio', 'rboi', 'ribo', 'riob', 'roib', 'robi',
            'obir', 'obri', 'oibr', 'oirb', 'orbi', 'orib');
        sort($expected);

        $resulted = $permutator->getPermutations();
        sort($resulted);

        $this->assertEquals(
            $expected,
            $resulted
        );


    }
}
 