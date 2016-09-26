<?php

/*
  Piotr Synowiec (c) 2016 psynowiec@gmail.com
 */

namespace Shop;

use Shop\Order;
use Shop\Product;

class OrderProducts implements \Iterator {

    private $id;
    private $order_id;
    private $products = array();
    private $postion = 0;

    public function __construct($order_id, $product_id, Product $product) {
        $this->id = -1;
        $this->order_id = $order_id;
        array_push($this->products, $product);
    }

    public function getId() {
        return $this->id;
    }

    public function getOrderId() {
        return $this->order_id;
    }

    public function current() {
        return $this->products[$this->position];
    }

    public function key() {
        return $this->position;
    }

    public function next() {
        ++$this->position;
    }

    public function rewind() {
        $this->position = 0;
    }

    public function valid() {
        return isset($this->products[$this->position]);
    }

}
