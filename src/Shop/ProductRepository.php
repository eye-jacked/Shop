<?php

namespace Shop;
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
        } catch (\PDOException $ex) {
            return false;
        }
    }
    

    public static function getProductById($id) {
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

