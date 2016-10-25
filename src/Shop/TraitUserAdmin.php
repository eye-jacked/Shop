<?php

/*
  Piotr Synowiec (c) 2016 psynowiec@gmail.com
 */

namespace Shop;

trait TraitUserAdmin
{

    public function validateEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            throw new \Exception('Wrong email address '.$email);
        }
    }

    public function validatePassword($password)
    {
        // # min 8 characters, max 20 , 1 UC, 1 digit
        if (preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $password)) {
            return true;
        } else {
            throw new \Exception('Password too weak. Required : min 8 - max 20 charactes, 1 upper case, 1 digit');
        }
    }

}
