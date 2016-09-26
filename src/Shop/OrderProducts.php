<?php
/**
 * Piotr Synowiec (c) 2016 psynowiec@gmail.com
 *
 * Date: 2016-09-26
 * Time:  7:30
 */

namespace Shop;

use Shop\Order;
use Shop\Product;

class OrderProducts implements \Iterator, \ArrayAccess {

    private $id;
    private $order_id;
    private $products = array();
    private $index = 0;

    public function __construct($order_id) {
        $this->id = -1;
       $this->order_id = $order_id;

    }

    public function addProduct($product_id, $quantity, $price) {
        $pr['id'] = $product_id;
        $pr['quantity'] = $quantity;
        $pr['price'] = $price;
        array_push($this->products, $pr);
    }

    public function removeProduct($id) {
        foreach($this->products as $index => $product) {
            if( $product['id'] == $id) {
                unset($this->products[$index]);
                break;
            }
        }
        $this->products = array_values($this->products);
    }

    public function getId() {
        return $this->id;
    }

    public function getOrderId() {
        return $this->order_id;
    }

    public function current() {
        return $this->products[$this->index];
    }

    public function key() {
        return $this->index;
    }

    public function next() {
        ++$this->index;
    }

    public function rewind() {
        $this->index = 0;
    }

    public function valid() {
        return array_key_exists($this->index, $this->products);
    }

    public function offsetExists($offset) {
        return array_key_exists($offset, $this->products);
    }

    public function offsetGet($offset) {
        return $this->products[$offset];
    }

    public function offsetSet($offset, $value) {
        $this->products[$offset] = $value;
    }

    public function offsetUnset($offset) {
        unset($this->products[$offset]);
    }

}
