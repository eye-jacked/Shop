<?php

/*
  Piotr Synowiec (c) 2016 psynowiec@gmail.com
 */

require_once __DIR__ . './../vendor/autoload.php';

use Shop\User;
use Shop\UserRepository;

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
        return $this->createFlatXMLDataSet('fixtures/fake-users.xml');
    }

    public function testGetRowCount() {
        $this->assertEquals(20, $this->getConnection()->getRowCount('users'));
    }

    public function testAddUser() {
        $fname = "Jan";
        $lname = "Kowalski";
        $email = "jan.kowalski@onet.pl";
        $password = "jan";
        $address = "Kasztanowa 7, 10-100 Kowal";
        $user = new User($fname, $lname, $email, $password, $address);

        $this->assertTrue(UserRepository::addUser($user));
        $this->assertFalse(UserRepository::addUser($user));
    }

    public function testGetUserById() {
        //var_dump(UserRepository::getUserById(1));
        $this->assertFalse(UserRepository::getUserById(100));
        $this->assertNotFalse(UserRepository::getUserById(1));
    }

    public function testAuthenticateUser() {
        $id = 8;
        $email = 'drohan@gmail.com';
        $pass = 'marlee';
        $this->assertEquals($id, UserRepository::authenticateUser($email, $pass));
        $pass = 'wrong_password';
        $this->assertFalse(UserRepository::authenticateUser($email, $pass));
    }

    public function testUpdateUser() {
        $id = 1;
        $user = UserRepository::getUserById($id);
        $fn = 'Jack';
        $ln = 'Sparrow';
        $user->setFname($fn);
        $user->setLname($ln);
        $this->assertTrue(UserRepository::updateUser($user));
        $chuser = UserRepository::getUserById($id);
        $this->assertEquals($fn, $chuser->getFname());
    }

    public function testPasswordChange() {
        $id = 1;
        $user = UserRepository::getUserById($id);
        $newpass = 'password';
        $user->setPassword($newpass);
        $email = $user->getEmail();
        UserRepository::updateUser($user);
        $this->assertEquals($id, UserRepository::authenticateUser($email, $newpass));
    }

}
