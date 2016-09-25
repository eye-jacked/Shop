<?php

/*
  Piotr Synowiec (c) 2016 psynowiec@gmail.com
 */

require_once __DIR__ . './../vendor/autoload.php';

use Shop\Admin;
use Shop\AdminRepository;

class AdminTest extends PHPUnit_Extensions_Database_TestCase {

    use VladaHejda\AssertException;

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
        return $this->createFlatXMLDataSet('fixtures/admins.xml');
    }

    public function testGetRowCount() {
        $this->assertEquals(2, $this->getConnection()->getRowCount('admins'));
    }

    public function testAddAdmin() {

        $email = "jan.kowalski@onet.pl";
        $password = "Password1";
        $admin = new Admin($email, $password);

        $this->assertTrue(AdminRepository::addAdmin($admin));
        $this->assertFalse(AdminRepository::addAdmin($admin));
    }

    public function testGetAdminById() {
        //var_dump(UserRepository::getUserById(1));
        $this->assertFalse(AdminRepository::getAdminById(100));
        $this->assertNotFalse(AdminRepository::getAdminById(1));
    }

    public function testAuthenticateAdmin() {
        $id = 1;
        $email = 'admin1@gmail.com';
        $pass = 'admin1';
        $this->assertEquals($id, AdminRepository::authenticateAdmin($email, $pass));
        $pass = 'wrong_password';
        $this->assertFalse(AdminRepository::authenticateAdmin($email, $pass));
    }

    public function testValidateEmail() {
        $email1 = 'janek#yenkee.com';
        $pass1 = 'Password1';

        // validation in constructor
        $this->assertException(function () {
            $admin1 = new Admin($email1, $pass1);
        });
    }

    public function testValidatePassword() {
        // validation in setPassword
        $email1 = 'janek@yenkee.com';
        $pass1 = 'Password1';

        $admin1 = new Admin($email1, $pass1);

        $pass2 = 'wrong';
        $this->assertException(function () {
            $admin1->setPassword($pass2);
        });

        $pass3 = 'Haslo2ok';

        $this->assertTrue($admin1->setPassword($pass3));
    }

}
