<?php

// ProductPhotosRepository

namespace Shop;

require_once __DIR__.'./../../vendor/autoload.php';
require_once 'DbConn.php';


class PhotoRepository
{

    public static function getProductPhoto($product_id)
    {
        $link = ProductPhotosRepository::getAllProductPhotos($product_id, 1);
        if ($link) {
            return $link[0];
        } else {
            return FALSE;
        }


    }

    public static function getAllProductPhotos($product_id, $limit = 0)
    {

        $sql = "SELECT `photo` FROM `product_photos` WHERE `product_id` = ?";

        if ($limit > 0) {
            $sql .= "  LIMIT 1";
        }
        $stm = \DbConn::conn()->prepare($sql);

        try {
            if ($stm->execute(){
            $res = $stm->fetchAll(\PDO::FETCH_CLASS);
            if (count($res) > 0) {
                return $res;

            } else {
                return false;
            }
        } catch (\PDOException $ex){
            return false;
        }

        // or false in case product doesn't have photo - in this case we have to use default dummy photo

    }
}