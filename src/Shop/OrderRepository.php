<?php
/**
 * Piotr Synowiec (c) 2016 psynowiec@gmail.com
 *
 * Date: 2016-09-27
 * Time: 08:30
 */

namespace Shop;

require_once __DIR__.'./../../vendor/autoload.php';
require_once 'DbConn.php';

use Shop\Order;

class OrderRepository
{

    public static function addOrder(Order $order)
    {
        $sql = "INSERT INTO `orders` (`user_id`, `status_id`) VALUES (?,?)";
        $pdo = \DbConn::conn();
        $stm = $pdo->prepare($sql);
        try {
            $stm->execute(array($order->getUserId(), $order->getStatusId()));
            return $pdo->lastInsertId();
        } catch (\PDOException $ex) {
            return false;
        }
    }

    public static function cancelOrder(Order $order)
    {
        $sql = "DELETE FROM `orders` WHERE `id` = ?";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            $stm->execute(array($order->getId()));
            if ($stm->rowCount() > 0) {
                return true;
            }
        } catch (\PDOException $ex) {
            return false;
        }
        return false;
    }

    public static function updateOrderStatus(Order $order, $status_id)
    {
        $sql = "UPDATE `orders` SET `status_id` = ? WHERE `id` = ?";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            $stm->execute(array( $status_id, $order->getId()));
            if ($stm->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $ex) {
            return false;
        }
        return false;
    }

    public static function getAllUserOrders($user_id)
    {
        $sql = "SELECT * FROM `orders` WHERE `user_id` = ?";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            $stm->execute(array($user_id));
            if ($stm->rowCount() > 0) {
                $res = $stm->fetchAll(\PDO::FETCH_CLASS);
                $orders = array();
                for ($i = 0; $i < count($res); $i++) {
                    $order = new Order($res[$i]->user_id);
                    $order->setStatusId($res[$i]->status_id);
                    $order->setId($res[$i]->id);
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

    public static function getOrderById($id)
    {
        $sql = "SELECT * FROM  `orders`  WHERE `id` = ?";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            $stm->execute(array($id));
            if ($stm->rowCount() > 0) {
                $res = $stm->fetchAll(\PDO::FETCH_CLASS);
                $order = new Order($res[0]->user_id);
                $order->setStatusId($res[0]->status_id);
                $order->setId($id);
                return $order;
            } else {
                return false;
            }
        } catch (\PDOException $ex) {
            return false;
        }
        return false;
    }
}