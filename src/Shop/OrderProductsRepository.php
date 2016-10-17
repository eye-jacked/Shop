<?php

/*
  Piotr Synowiec (c) 2016 psynowiec@gmail.com
 */

namespace Shop;

require_once __DIR__ . './../../vendor/autoload.php';
require_once 'DbConn.php';

use Shop\Order;
use Shop\Product;
use Shop\OrderProducts;

class OrderProductsRepository {

    public function addProductToOrder($order_id, Product $product)
    {
        //
    }

    public function delProductFromOrder($order_id, Product $product)
    {
        //
    }

    public function getAllProductsForOrder($order_id)
    {
        // return OrderProducts object
    }

}
