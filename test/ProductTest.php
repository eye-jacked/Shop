<?php

/*
  Piotr Synowiec (c) 2016 psynowiec@gmail.com
    THIS VERSION USED AND EDITED BY ROB STUGLIK.
 */

use Shop\Product;

require_once 'src/connection.php';

class ProductTest extends PHPUnit_Extensions_Database_TestCase {

    static private $pdo = null;
    private $conn = null;

    final public function getConnection() {
        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']);
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, $GLOBALS['DB_NAME']);
        }
        return $this->conn;
    }

    protected function getDataSet() {
        return $this->createFlatXMLDataSet('fixtures/products.xml');
    }

    public function testGetRowCount() {
        $this->assertEquals(5, $this->getConnection()->getRowCount('products'));
    }

    public function test1() {
       
    }

}
