<?php



namespace Shop;

require_once __DIR__.'./../../vendor/autoload.php';
require_once 'DbConn.php';


class PhotoRepository
{
    const FOLDER  = '../img/products/';

    /**
     *  Get single photo for Product
     *
     * @param $product_id
     * @return string|bool
     */
    public static function getProductPhoto($product_id)
    {
        $link = self::getAllProductPhotos($product_id, 1);
        if ($link) {
            return $link[0];
        } else {
            return false;
        }
    }


    /**
     * Get all photos for Product
     *
     * @param $product_id
     * @param int $limit
     * @return array|bool
     */
    public static function getAllProductPhotos($product_id, $limit = 0)
    {
        $sql = "SELECT `photo` FROM `product_photos` WHERE `product_id` = :id";


        if ($limit > 0) {
            $sql .= "  LIMIT :limit";
        }

        $stm = \DbConn::conn()->prepare($sql);

        if ($limit > 0) {
            $stm->bindParam('limit', $limit, \PDO::PARAM_INT);
        }

        try {
            $stm->bindParam('id', $product_id, \PDO::PARAM_INT);
            if ($stm->execute()) {
                $res = $stm->fetchAll(\PDO::FETCH_COLUMN);
                if (count($res) > 0) {
                    for ($i = 0; $i < count($res); $i++) {
                        $res[$i] = self::FOLDER . $res[$i];
                    }

                    return $res;
                }
            }
        } catch (\PDOException $ex) {
            return false;
        }

        return false;
    }
}