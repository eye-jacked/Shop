<?php

/*
  Piotr Synowiec (c) 2016 psynowiec@gmail.com
 */



require_once __DIR__ . './../../vendor/autoload.php';

class DbConn {

    public static function &conn() {
        $cfg = json_decode(file_get_contents('dbconfig.json', true));
        $conn = NULL;
        if ($conn == NULL) {
            try {
                $conn = new \PDO('mysql:host=' . $cfg->server . ';dbname=' . $cfg->dbname, $cfg->user, $cfg->pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'PDO Error: ' . $e->getMessage();
            }
        }
        return $conn;
    }

}

//$stm = DbConn::conn()->prepare('SELECT * FROM users');
//$stm->execute();
//$res = $stm->fetchAll(PDO::FETCH_CLASS);
//var_dump($res);
//var_dump($res[0]->id);
//var_dump($res[0]->fname);
