<?php

/*
  Piotr Synowiec (c) 2016 psynowiec@gmail.com
 */

namespace Shop;

require_once __DIR__ . './../../vendor/autoload.php';

require_once 'DbConn.php';

use Shop\User;

class UserRepository {

    /**
     *
     * @param User $user
     * @return boolean
     */
    public static function addUser(User $user) {

        $sql = "INSERT INTO `users` (`fname`,`lname`,`email`,`password`,`address`) VALUES (?,?,?,?,?)";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            return $stm->execute(array($user->getFname(), $user->getLname(), $user->getEmail(),
                        $user->getPassword(), $user->getAddress()));
        } catch (\PDOException $ex) {
            return false;
        }
    }

    /**
     * getUserById
     *
     * returns User from DB or FALSE
     *
     * @param int $id
     * @return boolean|User
     */
    public static function getUserById($id) {
        $sql = "SELECT * FROM `users` WHERE `id` = ?";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            if ($stm->execute(array($id))) {
                $res = $stm->fetchAll(\PDO::FETCH_CLASS);
                if (count($res) > 0) {
                    $u = $res[0];
                    return new User($u->fname, $u->lname, $u->email, $u->password, $u->address, $u->id);
                }
            }
            return false;
        } catch (\PDOException $ex) {
            return false;
        }
    }

    /**
     * authenticateUser
     *
     * authenticate user by email and password with DB
     *
     * @param string $email
     * @param string $password
     * @return int $id|boolean
     */
    public static function authenticateUser($email, $password) {
        // return user ID or false/
        $sql = "SELECT `id`, `password` FROM `users` WHERE `email` = ?";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            if ($stm->execute(array($email))) {
                $res = $stm->fetchAll(\PDO::FETCH_CLASS);
                if (count($res) == 1) {
                    $u = $res[0];
                    if (password_verify($password, $u->password)) {
                        return $u->id;
                    }
                }
            }
        } catch (\PDOException $ex) {
            return false;
        }
        return false;
    }

    /**
     * updateUser
     *
     * updates existing user in DB
     *
     * @param User $user
     * @return boolean
     */
    public static function updateUser(User $user) {
        $sql = "UPDATE `users` SET `fname`=?,`lname`=?,`email`=?,`password`=?,`address`=? WHERE `id`=?";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            return $stm->execute(array($user->getFname(), $user->getLname(),
                        $user->getEmail(), $user->getPassword(),
                        $user->getAddress(), $user->getId()));
        } catch (\PDOException $ex) {
            return false;
        }
        return false;
    }

}
