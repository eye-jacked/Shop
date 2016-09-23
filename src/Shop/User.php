<?php

/*
  Piotr Synowiec (c) 2016 psynowiec@gmail.com
 */

namespace Shop;

class User {

    static private $conn;
    private $id;
    private $fname;
    private $lname;
    private $email;
    private $password;
    private $address;

    // This function sets connection for this class to use
    // This function needs to be run on startup
    public static function SetConnection($newConnection) {
        User::$conn = $newConnection;
    }

    public static function CreateUser() {
        $sqlStatement = "Select * from users";
        $result = User::$conn->query($sqlStatement);
//        if ($result->num_rows == 0) {
//            //inserting user to db
//
//            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
//            $sqlStatement = "INSERT INTO users(name, email, password, info) values ('', '$userMail', '$hashed_password', '')";
//            if (User::$conn->query($sqlStatement) === TRUE) {
//                //entery was added to DB so we can return new object
//                return new User(User::$conn->insert_id, '', $userMail, '', $hashed_password);
//            }
//        }
    }

}
