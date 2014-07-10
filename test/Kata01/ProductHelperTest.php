<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/8/2014
 * Time: 12:02 AM
 */

namespace Kata\Test\Kata01;

use Kata\Kata01\Product;
use Kata\Kata01\Money;
use Kata\Kata01\ProductHelper;

class ProductHelperTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider productTypeDataProvider
     */
    public function testProductData(Product $productObject, $type, $price, $unit)
    {
        $this->assertEquals($type, $productObject->getType());
        $this->assertEquals($price, $productObject->getUnitPrice());
        $this->assertEquals($unit, $productObject->getUnit());
    }

    public function productTypeDataProvider()
    {
        return array(
            array(ProductHelper::factoryProductByType(ProductHelper::TYPE_APPLE), ProductHelper::TYPE_APPLE, new Money(32), ProductHelper::UNIT_KG),
            array(ProductHelper::factoryProductByType(ProductHelper::TYPE_LIGHT), ProductHelper::TYPE_LIGHT, new Money(15), ProductHelper::UNIT_YEAR),
            array(ProductHelper::factoryProductByType(ProductHelper::TYPE_STARSHIP), ProductHelper::TYPE_STARSHIP, new Money(999.99), ProductHelper::UNIT_PIECE),
        );
    }
    /**
     * @expectedException \Exception
     */
    public function testFactoryProductByTypeException() {
        ProductHelper::factoryProductByType('asd');

    }
}

