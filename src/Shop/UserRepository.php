<?php

/*
  Piotr Synowiec (c) 2016 psynowiec@gmail.com
 */

namespace Shop;

require_once __DIR__ . './../../vendor/autoload.php';

require_once 'DbConn.php';

use Shop\User;

class UserRepository {

    public static function addUser(User $user) {
        // logika zapisu do DB

        $sql = "INSERT INTO `users` (`fname`,`lname`,`email`,`password`,`address`) VALUES (?,?,?,?,?)";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            return $stm->execute(array($user->getFname(), $user->getLname(), $user->getEmail(),
                        $user->getPassword(), $user->getAddress()));
        } catch (\PDOException $ex) {
            return false;
        }
    }

    public function getUserById($id) {
        // return User $user
    }

    public function authenticateUser($email, $password) {
        // return user ID or false
    }

    public function updateUser(User $user) {

    }

    private function saveToDB(User $user) {

    }

}
