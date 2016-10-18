<?php

/*
  Piotr Synowiec (c) 2016 psynowiec@gmail.com
 */

namespace Shop;

class Admin {

    use TraitUserAdmin;

    private $id;
    private $email;
    private $hash_password;

    public function __construct($email, $password, $id = null) {
        $this->id = $id;
        $this->setEmail($email);
        $this->setPassword($password);
    }

    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->hash_password;
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

}
