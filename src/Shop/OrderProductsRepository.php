<?php

/*
  Piotr Synowiec (c) 2016 psynowiec@gmail.com
 */

namespace Shop;

require_once __DIR__.'./../../vendor/autoload.php';
require_once 'DbConn.php';


class OrderProductsRepository
{

    /**
     * Add new Product to Order or updates in case Product already exists in Order
     *
     * @param $order_id
     * @param $product
     * @param $product_quantity
     * @return bool
     */
    public static function addProductToOrder($order_id, $product, $product_quantity)
    {
        $product_id = $product->getId();
        if (!self::updateOrderProductInOrder($order_id, $product_id, $product_quantity)) {
            $sql = "INSERT INTO `order_products` (`order_id`, `product_id`, `product_quantity`, `product_price`) "
                ."VALUES (?,?,?,?)";
            $stm = \DbConn::conn()->prepare($sql);

            try {
                $stm->execute(array($order_id, $product_id, $product_quantity, $product->getPrice()));
                if ($stm->rowCount() > 0) {
                    return true;
                }
            } catch (\PDOException $ex) {
                return false;
            }

            return false;
        } else {
            return true;
        }
    }

    /**
     * Remove all products from order
     *
     * @param $order_id
     * @return bool
     */
    public static function delAllProductsFromOrder($order_id)
    {
        $sql = "DELETE FROM `order_products` WHERE `order_id` = ?";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            $stm->execute(array($order_id));
            if ($stm->rowCount() > 0) {
                return true;
            }
        } catch (\PDOException $ex) {
            return false;
        }

        return false;
    }

    /**
     * Remove single product from order
     *
     * @param $order_id
     * @param $product_id
     * @return bool
     */
    public static function delProductFromOrder($order_id, $product_id)
    {
        $sql = "DELETE FROM `order_products` WHERE `order_id` = ? AND product_id = ?";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            $stm->execute(array($order_id, $product_id));
            if ($stm->rowCount() > 0) {
                return true;
            }
        } catch (\PDOException $ex) {
            return false;
        }

        return false;
    }

    /**
     * Get OrderProduct object with all products
     * @param $order_id
     * @return bool|OrderProducts
     */
    public static function getAllOrderProductsForOrder($order_id)
    {
        $order_products = new OrderProducts($order_id);
        $sql = "SELECT * FROM `order_products` WHERE `order_id` = ?";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            $stm->execute(array($order_id));
            if ($stm->rowCount() > 0) {
                $res = $stm->fetchAll(\PDO::FETCH_CLASS);
                for ($i = 0; $i < count($res); $i++) {
                    $order_products->addProduct(
                        $res[$i]->product_id,
                        $res[$i]->product_quantity,
                        $res[$i]->product_price
                    );
                }

                return $order_products;
            }
        } catch (\PDOException $ex) {
            return false;
        }

        return false;
    }

    /**
     * Get array of best selling Products
     *
     * @param int $limit
     * @return array|bool 2 dimensional array (product_id, count)
     */
    public static function getMostPopularProducts($limit = 5)
    {
        $result = array();
        $sql = "SELECT `product_id`, SUM(`product_quantity`) AS `count` FROM `order_products` "
            ."GROUP BY `product_id` ORDER BY `count` DESC, `product_id` ASC LIMIT :limit";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            $stm->bindParam('limit', $limit, \PDO::PARAM_INT);
            $stm->execute();
            $res = $stm->fetchAll(\PDO::FETCH_CLASS);
            for ($i = 0; $i < count($res); $i++) {
                $arr = array($res[$i]->product_id, $res[$i]->count);
                array_push($result, $arr);
            }

            return $result;
        } catch (\PDOException $ex) {
            return false;
        }

        return false;
    }

    /**
     * Get OrderProduct Object from Order
     *
     * @param $order_id
     * @param $product_id
     * @return bool
     */
    public static function getOrderProductFromOrder($order_id, $product_id)
    {
        $sql = "SELECT * FROM `order_products` WHERE `order_id` = ? AND `product_id` = ?";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            $stm->execute(array($order_id, $product_id));
            if ($stm->rowCount() > 0) {
                $res = ($stm->fetchAll(\PDO::FETCH_CLASS))[0];
                $order_product = new OrderProducts($order_id);
                $order_product->setId($res->id);
                $order_product->addProduct($res->product_id, $res->product_quantity, $res->product_price);

                return $order_product;
            }
        } catch (\PDOException $ex) {
            return false;
        }

        return false;
    }

    /**
     * Update existing product quantity in order
     *
     * @param $order_id
     * @param $product_id
     * @param $product_quantity
     * @return bool
     */
    public static function updateOrderProductInOrder($order_id, $product_id, $product_quantity)
    {
        $sql = "UPDATE `order_products` SET `product_quantity` = ? WHERE `order_id` = ? AND `product_id` = ?";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            $stm->execute(array($product_quantity, $order_id, $product_id));
            if ($stm->rowCount() > 0) {
                return true;
            }
        } catch (\PDOException $ex) {
            return false;
        }

        return false;
    }

}
