<?php

/*
  Piotr Synowiec (c) 2016 psynowiec@gmail.com
 */

namespace Shop\User;

class User {

    static private $conn;
    private $id;
    private $fname;
    private $lname;
    private $email;
    private $password;
    private $address;

    public static function SetConnection($newConnection) {
        User::$conn = $newConnection;
    }

}
