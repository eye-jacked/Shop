<?php

/*
  Piotr Synowiec (c) 2016 psynowiec@gmail.com
 */

use Shop\User;

require_once 'src/connection.php';

class UserTest extends PHPUnit_Extensions_Database_TestCase {

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
//        return $this->createXMLDataSet('users.xml');
        return $this->createFlatXMLDataSet('fixtures/users.xml');
    }

    public function testGetRowCount() {
        $this->assertEquals(2, $this->getConnection()->getRowCount('users'));
    }

    public function test1() {
        User::CreateUser();
    }

}
