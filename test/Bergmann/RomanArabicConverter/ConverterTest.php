<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/24/2014
 * Time: 11:10 AM
 *
 * http://www.mots-croises.ch/Listes/chiffres_romains.htm
 */

namespace Kata\Test\Bergmann\RomanArabicConverter;

use Kata\Bergmann\RomanArabicConverter\Converter;

class ConverterTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Converter
     */
    private $converter;

    public function setUp() {
        $this->converter = new Converter();

    }

    /**
     * @dataProvider romanArabicPairProvider
     */
    public function testOne($roman, $arabic) {
        $this->assertEquals($roman, $this->converter->convertToArabic($arabic));
//        $this->assertEquals(1, $this->converter->convertToArabic('I'));
//        $this->assertEquals(2, $this->converter->convertToArabic('II'));
//        $this->assertEquals(3, $this->converter->convertToArabic('III'));
//
//        $this->assertEquals(5, $this->converter->convertToArabic('V'));
//        $this->assertEquals(6, $this->converter->convertToArabic('VI'));
//
//        $this->assertEquals(4, $this->converter->convertToArabic('IV'));
//
//        $this->assertEquals(7, $this->converter->convertToArabic('VII'));
//        $this->assertEquals(8, $this->converter->convertToArabic('VIII'));
//        $this->assertEquals(9, $this->converter->convertToArabic('IX'));
//
//        $this->assertEquals(10, $this->converter->convertToArabic('X'));
//        $this->assertEquals(11, $this->converter->convertToArabic('XI'));
//        $this->assertEquals(14, $this->converter->convertToArabic('XIV'));
//
//        $this->assertEquals(50, $this->converter->convertToArabic('L'));
//
//        $this->assertEquals(40, $this->converter->convertToArabic('XL'));
//        $this->assertEquals(60, $this->converter->convertToArabic('LX'));
//
//        $this->assertEquals(1776, $this->converter->convertToArabic('MDCCLXXVI'));
//
//        $this->assertEquals(1999, $this->converter->convertToArabic('MCMXCIX'));
//
//        $this->assertEquals(1989, $this->converter->convertToArabic('MCMLXXXIX'));

    }

    public function romanArabicPairProvider() {
        return array(
            array(1, 'I'),
            array(2, 'II'),
            array(3, 'III'),
            array(5, 'V'),
            array(6, 'VI'),
            array(4, 'IV'),
            array(7, 'VII'),
            array(8, 'VIII'),
            array(9, 'IX'),
            array(10, 'X'),
            array(11, 'XI'),
            array(14, 'XIV'),
            array(50, 'L'),
            array(40, 'XL'),
            array(60, 'LX'),
            array(1776, 'MDCCLXXVI'),
            array(1999, 'MCMXCIX'),
            array(1989, 'MCMLXXXIX'),
        );
    }

    /**
     * @expectedException Exception
     * @dataProvider invalidRomanNumberProvider
     *
     */
    public function testInvalidRomanNumber($invalidRomanNumber) {
        $this->assertEquals(218, $this->converter->convertToArabic($invalidRomanNumber));
    }

    public function invalidRomanNumberProvider() {
        return array(
            //array(''),
            array('IIX'),
            array('OOA'),
            array('XVX'),
        );
    }
}
 