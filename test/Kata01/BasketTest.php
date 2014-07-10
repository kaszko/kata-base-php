<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/7/2014
 * Time: 9:14 PM
 */

namespace Kata\Test\Kata01;


use Kata\Kata01\Product;
use Kata\Kata01\ProductHelper;
use Kata\Kata01\Type;
use Kata\Kata01\Basket;

class BasketTest extends \PHPUnit_Framework_TestCase {

    public function testAddAndRemoveProduct(array $addAndRemoves, array $typeCounts)
    }

    function xddAndRemoveProductDataProvider() {

        $array = array();

        $array[] = array(
            "addAndRemoves" => array(
            ),
            "typeCounts" => array(
                ProductHelper::TYPE_APPLE => array(0, 0),
                ProductHelper::TYPE_LIGHT => array(0, 0),
                ProductHelper::TYPE_STARSHIP => array(0, 0),
            )
        );

        $array[] = array(
            "addAndRemoves" => array(
                array(ProductHelper::TYPE_APPLE, 10),
            ),
            "typeCounts" => array(
                ProductHelper::TYPE_APPLE => array(0, 0),
                ProductHelper::TYPE_LIGHT => array(56, 0),
                ProductHelper::TYPE_STARSHIP => array(0, 0),
            )
        );

        $array[] = array(
            "addAndRemoves" => array(
                array("addProduct", ProductHelper::TYPE_APPLE, 10),
                array("removeProduct", ProductHelper::TYPE_APPLE, 20),
            ),
            "typeCounts" => array(
                ProductHelper::TYPE_APPLE => array(0, 0),
                ProductHelper::TYPE_LIGHT => array(56, 0),
                ProductHelper::TYPE_STARSHIP => array(0, 0),
            )
        );

        $array[] = array(
            "addAndRemoves" => array(
                array("addProduct", ProductHelper::TYPE_APPLE, 10),
                array("removeProduct", ProductHelper::TYPE_APPLE, 20),
                array("removeProduct", ProductHelper::TYPE_LIGHT, 56),
            ),
            "getItems" => array(
                ProductHelper::TYPE_APPLE => array(0, 0),
                ProductHelper::TYPE_LIGHT => array(56, 0),
                ProductHelper::TYPE_STARSHIP => array(0, 0),
            )
        );


        return $array;

    }


}
 