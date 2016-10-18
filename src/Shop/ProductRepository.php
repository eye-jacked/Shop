<?php

namespace Shop;

require_once __DIR__.'./../../vendor/autoload.php';
require_once 'DbConn.php';


class ProductRepository
{


    public static function addProduct(Product $product)
    {
        $sql = "INSERT INTO `products` (`name`,`stock`,`price`,`description`) VALUES (?,?,?,?)";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            return $stm->execute(array(
                $product->getName(),
                $product->getStock(),
                $product->getPrice(),
                $product->getDescription(),
            ));
        } catch (\PDOException $ex) {
            return false;
        }
    }


    public static function getProductById($id)
    {
        $sql = "SELECT * FROM `products` WHERE `id` = ?";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            if ($stm->execute(array($id))) {
                $res = $stm->fetchAll(\PDO::FETCH_CLASS);
                if (count($res) > 0) {
                    $p = $res[0];

                    return new Product($p->name, $p->stock, $p->price, $p->description, $p->id);
                }
            }

            return false;
        } catch (\PDOException $ex) {
            return false;
        }
    }

    public static function updateProduct(Product $product)
    {
        $sql = "UPDATE `products` SET `name`=?,`stock`=?,`price`=?,`description`=? WHERE `id`=?";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            $stm->execute(array(
                $product->getName(),
                $product->getStock(),
                $product->getPrice(),
                $product->getDescription(),
                $product->getId(),
            ));
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

    /**
     * getProducts
     *
     * returns array of Product object from DB
     *
     * @param $offset
     * @param $limit
     * @return bool| array Product
     */
    public static function getProducts($offset=2, $limit=20)
    {
        $sql = "SELECT * FROM `products` LIMIT :limit OFFSET :offset";

        $stm = \DbConn::conn()->prepare($sql);
        try {
            $stm->bindParam(':limit', $limit, \PDO::PARAM_INT);
            $stm->bindParam(':offset', $offset, \PDO::PARAM_INT);
            $stm->execute();
            if ($stm->rowCount() > 0) {

                $res = $stm->fetchAll(\PDO::FETCH_CLASS);
                $products = array(); //$name, $stock, $price, $description, $id = null
                for ($i = 0; $i < count($res); $i++) {
                    array_push(
                        $products,
                        new Product($res[$i]->name, $res[$i]->stock, $res[$i]->price, $res[$i]->description, $res[$i]->id)
                    );
                }

                return $products;
            } else {
                return false;
            }

        } catch (\PDOException $ex) {
            return $ex->getMessage();
//            return false;
        }
        return false;
    }

    public static function getProductCount()
    {
        $sql = "SELECT COUNT(*) AS `count` FROM `products`";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            $stm->execute();

            return intval($stm->fetchAll(\PDO::FETCH_CLASS)[0]->count);
        } catch (\PDOException $ex) {

            return false;
        }
    }

}

$products = ProductRepository::getProducts(1,1);
var_dump($products);
