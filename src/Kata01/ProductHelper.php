<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/7/2014
 * Time: 10:08 PM
 */

namespace Kata\Kata01;


class ProductHelper {
    const TYPE_APPLE = "apple";
    const TYPE_LIGHT = "light";
    const TYPE_STARSHIP = "starship";

    const UNIT_KG = "kg";
    const UNIT_YEAR = "year";
    const UNIT_PIECE = "piece";

    /**
     * @param $type Type of product.
     * @return \Tdd\Product
     * @throws Exception
     * @todo Only product class needed
     */
    public static function factoryProductByType($type) {

        if ($type == self::TYPE_APPLE) {
            return new Product(self::TYPE_APPLE, new Money(32), self::UNIT_KG);
        }
        if ($type == self::TYPE_LIGHT) {
            return new Product(self::TYPE_LIGHT, new Money(15), self::UNIT_YEAR);
        }
        if ($type == self::TYPE_STARSHIP) {
            return new Product(self::TYPE_STARSHIP, new Money(999.99), self::UNIT_PIECE);
        }
        throw new \Exception('Invalid type!');
    }

}