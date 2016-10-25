<?php

/**
  Piotr Synowiec (c) 2016 psynowiec@gmail.com
 */

namespace Shop;

class User {

    use TraitUserAdmin;

    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $hash_password;
    private $address;

    public function __construct($firstName, $lastName, $email, $password, $address = '', $id = null) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->setEmail($email);
        $this->setPassword($password);
        $this->address = $address;
    }

    public function getId() {
        return $this->id;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
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

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function setEmail($email) {
        if ($this->validateEmail($email)) {
            $this->email = $email;
            return TRUE;
        }
    }

    public function setPassword($password) {
        if ($this->validatePassword($password)) {
            $this->hash_password = password_hash($password, PASSWORD_BCRYPT);
            return TRUE;
        }
    }

    public function setAddress($address) {
        $this->address = $address;
    }

}
