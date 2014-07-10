<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/7/2014
 * Time: 9:15 PM
 */

namespace Kata\Kata01;


class Basket {

    /**
     * @var array
     */
    private $items = array();

    public function addProduct($productType, $addQuantity) {

        if (!isset($this->items[$productType])) {
            $this->items[$productType] = ProductHelper::factoryProductByType($productType);
        }

        $this->items[$productType]->increaseQuantityBy($addQuantity);

    }

    public function removeProduct($productType, $removeQuantity = null) {
        if (isset($this->items[$productType])) {
            if ($removeQuantity === null) {
                $removeQuantity = $this->items[$productType]->getQuantity();
            }

            $this->items[$productType]->decreaseQuantityBy($removeQuantity);

            if ($this->items[$productType]->getQuantity() == 0) {
                unset($this->items[$productType]);
            }
        }

    }

    public function getItems() {
        return $this->items;
    }
} 