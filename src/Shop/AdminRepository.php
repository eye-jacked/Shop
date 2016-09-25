<?php

/*
  Piotr Synowiec (c) 2016 psynowiec@gmail.com
 */

namespace Shop;

require_once __DIR__ . './../../vendor/autoload.php';

require_once 'DbConn.php';

use Shop\Admin;

class AdminRepository {

    /**
     *
     * @param Admin $admin
     * @return boolean
     */
    public static function addAdmin(Admin $admin) {

        $sql = "INSERT INTO `admins` (`email`,`password`) VALUES (?,?)";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            return $stm->execute(array($admin->getEmail(), $admin->getPassword()));
        } catch (\PDOException $ex) {
            return false;
        }
    }

    /**
     * getAdminById
     *
     * returns Admin from DB or FALSE
     *
     * @param int $id
     * @return boolean|Admin
     */
    public static function getAdminById($id) {
        $sql = "SELECT * FROM `admins` WHERE `id` = ?";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            if ($stm->execute(array($id))) {
                $res = $stm->fetchAll(\PDO::FETCH_CLASS);
                if (count($res) > 0) {
                    $u = $res[0];
                    return new Admin($u->email, $u->password, $u->id);
                }
            }
            return false;
        } catch (\PDOException $ex) {
            return false;
        }
    }

    /**
     * authenticateAdmin
     *
     * authenticate admin by email and password with DB
     *
     * @param string $email
     * @param string $password
     * @return int $id|boolean
     */
    public static function authenticateAdmin($email, $password) {
        // return user ID or false/
        $sql = "SELECT `id`, `password` FROM `admins` WHERE `email` = ?";
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
     * updateAdmin
     *
     * updates existing user in DB
     *
     * @param Admin $admin
     * @return boolean
     */
    public static function updateAdmin(Admin $admin) {
        $sql = "UPDATE `admins` SET `email`=?,`password`=? WHERE `id`=?";
        $stm = \DbConn::conn()->prepare($sql);
        try {
            return $stm->execute(array($admin->getEmail(), $admin->getPassword(), $admin->getId()));
        } catch (\PDOException $ex) {
            return false;
        }
        return false;
    }

}
