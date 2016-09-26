<?php
/**
 * Piotr Synowiec (c) 2016 psynowiec@gmail.com
 *
 * Date: 2016-09-26
 * Time: 19:40
 */

require_once __DIR__ . './../vendor/autoload.php';
use Shop\OrderProducts;

class OrderProductsTest extends PHPUnit_Framework_TestCase
{

    public function testAddProducts()
    {
        $order_id = 1;
        $op = new OrderProducts($order_id);
        for( $i = 0; $i < 10; $i++ ){
            // $product_id, $quantity, $price
            $op->addProduct( $i+1, rand(2,5), rand(100, 120));
        }

        //var_dump($op);
        echo PHP_EOL;
        foreach ($op as $p ){
            echo $op->key() . " : " . $p['id'] . " : " .$p['quantity'] . " : " . $p['price']. PHP_EOL;
        }

        $op->removeProduct(5);

        echo PHP_EOL;
        foreach ($op as $p ){
            echo $op->key() . " : " . $p['id'] . " : " .$p['quantity'] . " : " . $p['price']. PHP_EOL;
        }

    }
}