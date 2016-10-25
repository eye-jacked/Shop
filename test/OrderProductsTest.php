<?php
/**
 * Piotr Synowiec (c) 2016 psynowiec@gmail.com
 *
 * Date: 2016-09-26
 * Time: 19:40
 */

require_once __DIR__.'./../vendor/autoload.php';

use Shop\Product;
use Shop\ProductRepository;
use Shop\OrderProducts;
use Shop\OrderProductsRepository;

class OrderProductsTest extends PHPUnit_Extensions_Database_TestCase
{
    static private $pdo = null;
    private $conn = null;

    final public function getConnection()
    {
        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']);
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, $GLOBALS['DB_NAME']);
        }

        return $this->conn;
    }


    protected function getDataSet()
    {
        $ds1 = $this->createFlatXmlDataSet('fixtures/products.xml');
        $ds2 = $this->createFlatXmlDataSet('fixtures/orders.xml');
        $ds3 = $this->createFlatXmlDataSet('fixtures/order_products.xml');

        $compositeDs = new PHPUnit_Extensions_Database_DataSet_CompositeDataSet();
        $compositeDs->addDataSet($ds1);
        $compositeDs->addDataSet($ds2);
        $compositeDs->addDataSet($ds3);

        return $compositeDs;
    }


    public function testAddProductToOrder()
    {
        $product = ProductRepository::getProductById(2);
        $order_id = 1;
        $product_quantity = 2;

        $this->assertTrue(OrderProductsRepository::addProductToOrder($order_id, $product, $product_quantity));
        $this->assertEquals(13, $this->getConnection()->getRowCount('order_products'));

        $product_quantity = 10;
        $this->assertTrue(OrderProductsRepository::addProductToOrder($order_id, $product, $product_quantity));
        $this->assertEquals(13, $this->getConnection()->getRowCount('order_products'));
    }


    public function testGetOrderProductFromOrder()
    {
        // just get
        $order_id = 1;
        $product_id = 3;
        $this->assertInstanceOf(
            OrderProducts::class,
            OrderProductsRepository::getOrderProductFromOrder($order_id, $product_id)
        );

        // add first and retrieve it from db
        $product = ProductRepository::getProductById(3);
        $order_id = 1;
        $product_quantity = 2;

        $this->assertTrue(OrderProductsRepository::addProductToOrder($order_id, $product, $product_quantity));
        $this->assertInstanceOf(
            OrderProducts::class,
            OrderProductsRepository::getOrderProductFromOrder($order_id, $product->getId())
        );
    }


    public function testValuesGetOrderProductFromOrder()
    {
        $order_id = 1;
        $product_id = 3;
        $order_product = OrderProductsRepository::getOrderProductFromOrder($order_id, $product_id);

        $exp_id = 2;
        $exp_quantity = 7;
        $exp_price = 70;
        $this->assertEquals($exp_id, $order_product->getId());
        $this->assertEquals($exp_quantity, $order_product->current()['quantity']);
        $this->assertEquals($exp_price, $order_product->current()['price']);
        $this->assertEquals($product_id, $order_product->current()['id']);
    }


    public function testGetAllOrderProductsForOrder()
    {
        $order_id = 1;
        $order_products = OrderProductsRepository::getAllOrderProductsForOrder($order_id);
        $this->assertEquals(2, $order_products->getProductCount());

        $exp_price[0] = 19;
        $exp_price[1] = 70;
        $i = 0;
        foreach ($order_products as $product) {
            $this->assertEquals($exp_price[$i], $product['price']);
            $i++;
        }
    }


    public function testGetMostPopularProducts()
    {
        $limit = 3;
        $mpops = OrderProductsRepository::getMostPopularProducts($limit);
        $pid = array(3, 1, 2);
        $pidcount = array(9, 5, 2);
        for ($i = 0; $i < $limit; $i++) {
            $this->assertEquals($pid[$i], $mpops[$i][0]);
            $this->assertEquals($pidcount[$i], $mpops[$i][1]);
        }
    }


    public function testDelAllProductsFromOrder()
    {
        $this->assertEquals(12, $this->getConnection()->getRowCount('order_products'));
        OrderProductsRepository::delAllProductsFromOrder(6);
        $this->assertEquals(9, $this->getConnection()->getRowCount('order_products'));
    }


    public function testDelProductFromOrder()
    {
        $this->assertEquals(12, $this->getConnection()->getRowCount('order_products'));
        OrderProductsRepository::delProductFromOrder(1, 3);
        $this->assertEquals(11, $this->getConnection()->getRowCount('order_products'));
    }


    public function testUpdateOrderProductInOrder()
    {
        $op1 = OrderProductsRepository::getOrderProductFromOrder(3, 2);
        $this->assertEquals($op1, OrderProductsRepository::getOrderProductFromOrder(3, 2));
        OrderProductsRepository::updateOrderProductInOrder(3, 2, 3);
        $this->assertNotEquals($op1, OrderProductsRepository::getOrderProductFromOrder(3, 2));
    }


}