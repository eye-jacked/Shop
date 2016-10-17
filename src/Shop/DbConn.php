<?php

/*
  Piotr Synowiec (c) 2016 psynowiec@gmail.com
 */

require_once __DIR__.'./../../vendor/autoload.php';

class DbConn
{

    public static function &conn()
    {
        $cfg = json_decode(file_get_contents('dbconfig.json', true));
        $conn = null;
        if ($conn == null) {
            try {
                $conn = new \PDO('mysql:host='.$cfg->server.';dbname='.$cfg->dbname, $cfg->user, $cfg->pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'PDO Error: '.$e->getMessage();
            }
        }

        return $conn;
    }

}
