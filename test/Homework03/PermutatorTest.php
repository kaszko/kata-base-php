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

    private function assertArrayValuesEqual($expected, $actual, $message = '', $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false) {
        if (is_array($expected) && is_array($actual)) {
            $sortedExpected = sort($expected);
            $sortedActual = sort($actual);
            return $this->assertEquals($sortedExpected, $sortedActual, $message, $delta, $maxDepth,$canonicalize, $ignoreCase);
        }
        else {
            throw new \Exception('Trying to assert not arrays with ' . _assertArrayValuesEqual);
        }
    }

    public function testGetPermutations() {
        $permutator = new Permutator();
        $permutator->setString('a');
        $this->assertArrayValuesEqual(
            array('a'),
            $permutator->getPermutations()
        );

        $permutator = new Permutator();
        $permutator->setString('ab');
        $this->assertArrayValuesEqual(
            array('ab', 'ba'),
            $permutator->getPermutations()
        );

        $permutator = new Permutator();
        $permutator->setString('abc');
        $this->assertArrayValuesEqual(
            array('abc', 'acb', 'bac', 'bca', 'cab', 'cba'),
            $permutator->getPermutations()
        );

        $permutator = new Permutator();
        $permutator->setString('biro');

        $this->assertArrayValuesEqual(
            array('biro', 'bior', 'brio', 'broi', 'boir', 'bori',
                'ibro', 'ibor', 'irbo', 'irob', 'iobr', 'iorb',
                'rbio', 'rboi', 'ribo', 'riob', 'roib', 'robi',
                'obir', 'obri', 'oibr', 'oirb', 'orbi', 'orib'),
            $permutator->getPermutations()
        );



    }
}
 