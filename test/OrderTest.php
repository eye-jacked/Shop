<?php
/**
 * Piotr Synowiec (c) 2016 psynowiec@gmail.com
 *
 * Date: 2016-09-26
 * Time: 19:40
 */

require_once __DIR__.'./../vendor/autoload.php';

use Shop\Order;
use Shop\OrderRepository;


class OrderTest extends PHPUnit_Extensions_Database_TestCase
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


    public function test_addOrder()
    {
        $user_id = 1;
        $order = new Order(1);

        $this->assertEquals(11, OrderRepository::addOrder($order));
    }

    public function test_getAllUserOrders()
    {
        $orders = OrderRepository::getAllUserOrders(1);
        $this->assertEquals(5, count($orders));
        $order = $orders[0];
        $this->assertInstanceOf(Order::class, $order);

    }
}