<?php

/*
  Piotr Synowiec (c) 2016 psynowiec@gmail.com
 */

namespace Shop;

require_once __DIR__.'./../../vendor/autoload.php';
require_once 'DbConn.php';


class OrderProductsRepository
{

    public static function addProductToOrder($order_id, Product $product, $product_quantity)
    {
        // think about updating quantity in case product is already in order
        // to avoid having two the same products in one order :)
        $sql = "INSERT INTO `order_products` (`order_id`, `product_id`, `product_quantity`, `product_price`) VALUES (?,?,?,?)";
        $stm = \DbConn::conn()->prepare($sql);

        try {
            $stm->execute(array($order_id, $product->getId(), $product_quantity, $product->getPrice()));

            if ($stm->rowCount() > 0) {
                return true;
            }
        } catch (\PDOException $ex) {
            return false;
        }

        return false;
    }


    public static function delProductFromOrder($order_id, Product $product)
    {
        // 1. retrieve product from order
        // 2. check quantity and store the value
        // 3. remove product record from order_products
        // 4. update stock with quantity
        //
    }

    public static function getAllProductsForOrder($order_id)
    {
        $order_products = new OrderProducts($order_id);
        $sql = "SELECT * FROM `order_products` WHERE `order_id` = ?";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            $stm->execute(array($order_id));
            if ($stm->rowCount() > 0) {
                $res = $stm->fetchAll(\PDO::FETCH_CLASS);
                for ($i = 0; $i < count($res); $i++) {
                    $order_products->addProduct($res->product_id, $res->quantity, $res->price);
                }

                return $order_products;
            }
        } catch (\PDOException $ex) {
            return false;
        }

        return false;

    }

    /**
     * @param $order_id
     * @param $product_id
     */
    private static function getProductFromOrder($order_id, $product_id)
    {
        $sql = "SELECT * FROM `order_products` WHERE `order_id` = ? AND `product_id` = ?";
        $stm = \DbConn::conn()->prepare($sql);

    }
}
