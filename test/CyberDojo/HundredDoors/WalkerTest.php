<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/16/2014
 * Time: 6:03 PM
 */

namespace Kata\Test\CyberDojo\HundredDoors;

use Kata\CyberDojo\HundredDoors\Doors;
use Kata\CyberDojo\HundredDoors\Walker;

class WalkerTest extends \PHPUnit_Framework_TestCase {


    public function testFirstWalk()
    {
        $doors = $this->getMockBuilder('Kata\\CyberDojo\\HundredDoors\\Doors')->getMock();
        $doors->expects($this->at(0))->method('getCount')->will($this->returnValue(100));

//        $doors->expects($this->at(1))->method('toggleDoor')->with(0)->will($this->returnValue(null));
//        $doors->expects($this->at(2))->method('toggleDoor')->with(1)->will($this->returnValue(null));
        for ($i = 0; $i < 100; $i++) {
            $doors->expects($this->at($i+1))->method('toggleDoor')->with($i+1);
        }

        $walker = new Walker();
        $walker->setDoors($doors);
        $walker->walkOnEvery(1);
    }

    public function testSecondWalk() {
        $doors = $this->getMockBuilder('Kata\\CyberDojo\\HundredDoors\\Doors')->getMock();
        $doors->expects($this->at(0))->method('getCount')->will($this->returnValue(100));

//        $doors->expects($this->at(1))->method('toggleDoor')->with(0)->will($this->returnValue(null));
//        $doors->expects($this->at(2))->method('toggleDoor')->with(1)->will($this->returnValue(null));
        $c = 1;
        for ($i = 0; $i < 100; $i++) {
            if (($i+1)%2 == 0) {
                $doors->expects($this->at($c++))->method('toggleDoor')->with($i+1);
            }

        }

        $walker = new Walker();
        $walker->setDoors($doors);
        $walker->walkOnEvery(2);
    }

    /**
     * Az integracios teszt vart eredemenyek meghataraozasanal a kovetkezoket hasznaltam:
     *
     * - X-edik vegigjaras eseteben azon ajtokat nyitjuk ki, aminek sorszama oszthato X-el
     * - minden ajtot pontosan az osztoinak szama alkalommal kilicselunk meg
     * - a vegen egy ajto akkor lesz nyitva, ha paratlan szamu kilincseles tortenik
     * - a vegen egy ajto akkor lesz nyitva, ha az osztoinak szama paratlan (mert 1nel es onmaganal mindig kinyitod)
     * - az osztok szama = primtenyezos felbontas hatvanykitevo+1 szorzata
     * - egy szorzat akkor es csak akkor paratlan, ha minden szorzoja paratlan
     * - szorzo = hatvanykitevo + 1 = paratlan <=> hatvanykitevo paros
     * - tehat a primtenyezos felbontas minden hatvanykitevoje paros
     * - tehat a szam negyzetszam
     * - tehat egy ajto akkor lesz a bejaras utan nyitva, ha a sorszama negyzetszam
     */
    public function testIntegration() {

        $walker = new Walker();


        $doors = new Doors(1);
        $walker->setDoors($doors);
        $walker->walkThrough();
        $this->assertEquals(array(1), $doors->getOpenedDoors());

        $doors = new Doors(2);
        $walker->setDoors($doors);
        $walker->walkThrough();
        $this->assertEquals(array(1), $doors->getOpenedDoors());

        $doors = new Doors(3);
        $walker->setDoors($doors);
        $walker->walkThrough();
        $this->assertEquals(array(1), $doors->getOpenedDoors());

        $doors = new Doors(4);
        $walker->setDoors($doors);
        $walker->walkThrough();
        $this->assertEquals(array(1,4), $doors->getOpenedDoors());

        $doors = new Doors(50);
        $walker->setDoors($doors);
        $walker->walkThrough();
        $this->assertEquals(array(1,4,9,16,25,36,49), $doors->getOpenedDoors());

        $doors = new Doors(100);
        $walker->setDoors($doors);
        $walker->walkThrough();

        $this->assertEquals(array(1,4,9,16,25,36,49,64,81,100), $doors->getOpenedDoors());
    }
}
 