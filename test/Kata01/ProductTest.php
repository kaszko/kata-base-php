<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/7/2014
 * Time: 8:53 PM
 */

namespace Kata\Test\Kata01;

use Kata\Kata01\Product;
use Kata\Kata01\ProductHelper;
use Kata\Kata01\Money;

class ProductTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider productMetaProvider
     * @param $type
     * @param Money $unitPrice
     * @param $unit
     */
    public function testProductCreate($type, Money $unitPrice, $unit) {
        $product = new Product($type, $unitPrice, $unit);
        $this->assertEquals($type, $product->getType());
        $this->assertEquals($unitPrice, $product->getUnitPrice());
        $this->assertEquals($unit, $product->getUnit());
    }

    /**
     * Data provider for product testing
     *
     * @return array
     */
    public function productMetaProvider() {
        return array(
            array('asdasda', new Money(100), 'kg'),
            array(ProductHelper::TYPE_LIGHT, new Money(50), ProductHelper::UNIT_KG),
        );
    }

}
 