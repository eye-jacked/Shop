<?php
/**
 * Piotr Synowiec (c) 2016 psynowiec@gmail.com
 *
 * Date: 2016-09-27
 * Time: 08:30
 */

namespace Shop;

require_once __DIR__ . './../../vendor/autoload.php';
require_once 'DbConn.php';

use Shop\Order;

class OrderRepository
{

    public static function addOrder(Order $order)
    {
        $sql = "INSERT INTO `orders` (`user_id`, `status_id`) VALUES (?,?)";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            return $stm->execute(array($order->getUserId(), $order->getStatusId()));
        } catch (\PDOException $ex) {
            return false;
        }
    }

    public static function cancelOrder(Order $order)
    {
        $sql = "DELETE FROM `orders` WHERE `id` = ?";
    }

    public static function updateOrderStatus(Order $order, $status_id)
    {
        $sql = "UPDATE `orders` SET `status_id` = ?";
    }

    public static function getAllUserOrders($user_id)
    {
        $sql = "SELECT * FROM `orders` WHERE `user_id = ?`";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            $stm->execute(array($user_id));
            if ($stm->rowCount() > 0) {
                $res = $stm->fetchAll(\PDO::FETCH_CLASS);
                $orders = array(); //$id, $user_id, $status_id
                for ($i = 0; $i < count($res); $i++) {
                    $order = Order($res->user_id, $res->status_id);
                    $order->setId($res->id);
                    array_push(
                        $orders,
                        $order
                    );
                }
                return $orders;
            } else {
                return false;
            }

        } catch (\PDOException $ex) {
            return false;
        }

        return false;
    }

}