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


    public function testAddOrder()
    {
        $user_id = 1;
        $order = new Order($user_id);

        $inserted_id = 11;

        $this->assertEquals($inserted_id, OrderRepository::addOrder($order));
        $this->assertEquals($inserted_id, $order->getId());
    }

    public function testCancelOrder()
    {
        $user_id = 1;
        $order = new Order($user_id);

        $inserted_id = 11;
        OrderRepository::addOrder($order);
        $this->assertInstanceOf(Order::class, OrderRepository::getOrderById($inserted_id));
        $this->assertTrue(OrderRepository::cancelOrder($order));
        $this->assertFalse(OrderRepository::getOrderById($inserted_id));
    }


    public function testGetAllUserOrders()
    {
        $number_of_user_orders = 5;
        $orders = OrderRepository::getAllUserOrders(1);
        $this->assertEquals($number_of_user_orders, count($orders));
        $order1 = $orders[0];
        $this->assertInstanceOf(Order::class, $order1);

        $order2 = $orders[2];
        $id = 5;
        $user_id = 1;
        $status_id = 2;
        $this->assertInstanceOf(Order::class, $order2);
        $this->assertEquals($id, $order2->getId());
        $this->assertEquals($user_id, $order2->getUserId());
        $this->assertEquals($status_id, $order2->getStatusId());
    }


    public function testGetOrderById()
    {
        $user_id = 1;
        $order = new Order($user_id);

        $inserted_id = 11;
        OrderRepository::addOrder($order);

        $this->assertInstanceOf(Order::class, OrderRepository::getOrderById($inserted_id));
        $this->assertFalse(OrderRepository::getOrderById(100));
    }


    public function testUpdateOrderStatus()
    {
        $order_id = 1;
        $new_order_status = 3;
        $order1 = OrderRepository::getOrderById($order_id);
        OrderRepository::updateOrderStatus($order1, $new_order_status);

        $order2 = OrderRepository::getOrderById($order_id);
        $this->assertEquals($new_order_status, $order2->getStatusId());
    }


}