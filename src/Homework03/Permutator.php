<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/17/2014
 * Time: 10:17 PM
 */

namespace Kata\Homework03;

use Kata\Homework03\PermutationHelper;

class Permutator {
    private $string = '';

    private $permutations = array();

    public function setString($string) {
        $this->string = $string;
    }
    public function getPermutations() {
        $this->permutations = array();
        $this->generatePermutations($this->string, '');
        return $this->permutations;
    }

    private function generatePermutations($string, $prefix) {
        $permutationBases = PermutationHelper::generateBases($string);
        if (count($permutationBases) > 1) {
            foreach ($permutationBases as $basePrefix => $baseRest) {
                $this->generatePermutations($baseRest, $prefix . $basePrefix);
            }
        }
        else {
            $this->permutations[] = $prefix . $string;
        }
    }


} 