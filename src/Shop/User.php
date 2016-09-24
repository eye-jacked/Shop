<?php

/*
  Piotr Synowiec (c) 2016 psynowiec@gmail.com
 */

namespace Shop;

class User {

    private $id;
    private $fname;
    private $lname;
    private $email;
    private $hash_password;
    private $address;

    public function __construct($fname, $lname, $email, $password, $address, $id = null) {
        $this->id = $id;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->setPassword($password);
        $this->address = $address;
    }

    public function getId() {
        return $this->id;
    }

    public function getFname() {
        return $this->fname;
    }

    public function getLname() {
        return $this->lname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->hash_password;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setFname($fname) {
        $this->fname = $fname;
    }

    public function setLname($lname) {
        $this->lname = $lname;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->hash_password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function setAddress($address) {
        $this->address = $address;
    }

}
