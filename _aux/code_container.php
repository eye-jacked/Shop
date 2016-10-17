<?php


/* ProductPhotosRepository

public static function getProductPhoto( $product_id ) {


    $link = ProductPhotosRepository::getAllProductPhotos( $product_id, 1 );
    if( $link ) {
        return $link[0];
    }
    else {
        return FALSE;
    }

    // return string with single link to photo
    // or false in case product doesn't have photo - in this case we have to use default dummy photo


}

public static function getAllProductPhotos( $product_id, $limit = 0 ) {

    sql = "SELECT `photo` FROM `product_photos` WHERE `product_id` = ?";

    if ( $limit > 0 ) {
        sql .= "  LIMIT 1";
    }

    // rest of logic

    / return array strings with photo links
    // or false in case product doesn't have photo - in this case we have to use default dummy photo


}




 */

//
////status zamówienia
//
//status zamówienia (oczekujące, złożone, opłacone, zrealizowane),
// /*
//  $stm = DB::conn()->prepare('SELECT * FROM users');
//  $stm->execute();
//  $res = $stm->fetchAll(PDO::FETCH_CLASS);
//  var_dump($res);
//  var_dump($res[0]->id);
//  var_dump($res[0]->fname);
// */
//
///*
// * Function name
// *
// * what the function does
// *
// * @param (type) about this param
// * @return (type)
// */
//function example($name)
//
///*
// * What the function does
// *
// * @param (name) about this param
// * @return (name)
// */
//function example($name)
//
///**
// * Function name
// *
// * what the function does
// *
// * @param (type) (name) about this param
// * @return (type) (name)
// */
//function example($name)
//
///**
// * Function name
// * what the function does
// *
// * Parameters:
// *     (name) - about this param
// */
//function example($name)
//
//
//// # min 8 characters , 1 UC, 1 digit
//// preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $password)
//// # above plus one special character
//// preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password)