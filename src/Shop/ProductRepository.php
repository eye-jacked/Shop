<?php

namespace Shop;
<<<<<<< HEAD

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
=======
require_once __DIR__ . './../../vendor/autoload.php';
require_once 'DbConn.php';

use Shop\Product;

class ProductRepository {

    
    public static function addProduct(Product $product) {
        $sql = "INSERT INTO `products` (`name`,`stock`,`price`,`description`) VALUES (?,?,?,?)";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            return $stm->execute(array($product->getName(), $product->getStock(), $product->getPrice(),
                $product->getDescription()));
>>>>>>> e212dda92d6d7c5779edf86e401122f4813e3bc8
        } catch (\PDOException $ex) {
            return false;
        }
    }
<<<<<<< HEAD


    public static function getProductById($id)
    {
=======
    

    public static function getProductById($id) {
>>>>>>> e212dda92d6d7c5779edf86e401122f4813e3bc8
        $sql = "SELECT * FROM `products` WHERE `id` = ?";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            if ($stm->execute(array($id))) {
                $res = $stm->fetchAll(\PDO::FETCH_CLASS);
                if (count($res) > 0) {
                    $p = $res[0];
<<<<<<< HEAD

                    return new Product($p->name, $p->stock, $p->price, $p->description, $p->id);
                }
            }

=======
                    return new Product($p->name, $p->stock, $p->price, $p->description, $p->id);
                }
            }
>>>>>>> e212dda92d6d7c5779edf86e401122f4813e3bc8
            return false;
        } catch (\PDOException $ex) {
            return false;
        }
    }

<<<<<<< HEAD
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
    public static function getProducts($offset, $limit)
    {
        $sql = "SELECT * FROM `products` LIMIT ? OFFSET ?";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            $stm->execute(array($limit, $offset));
            if ($stm->rowCount() > 0) {
                $res = $stm->fetchAll(\PDO::FETCH_CLASS);
                $products = array(); //$name, $stock, $price, $description, $id = null
                for ($i = 0; $i < count($res); $i++) {
                    array_push(
                        $products,
                        new Product($res->name, $res->stock, $res->price, $res->description, $res->id)
                    );
                }

                return $products;
            } else {
                return false;
            }

        } catch (\PDOException $ex) {
            return false;
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

var_dump(ProductRepository::getProductCount());
=======

    public static function updateProduct(Product $product) {
        $sql = "UPDATE `products` SET `name`=?,`stock`=?,`price`=?,`description`=? WHERE `id`=?";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            $stm->execute(array($product->getName(), $product->getStock(), $product->getPrice(),
                $product->getDescription(), $product->getId()));
            if($stm->rowCount()>0){
                return TRUE;
            }
            else{
                return FALSE;
            }
        } catch (\PDOException $ex) {
            return false;
        }
        return false;
    }
}

>>>>>>> e212dda92d6d7c5779edf86e401122f4813e3bc8
