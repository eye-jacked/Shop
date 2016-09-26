<?php

/*
  Piotr Synowiec (c) 2016 psynowiec@gmail.com
 */


$password = "hasełko";

for ($i = 0; $i < 50; $i++) {
    echo password_hash($password, PASSWORD_BCRYPT) . "<br>";
}

//$hash1 = '$2y$10$0h5DPzPGBydHKTkoaSg9veUl0oXgGA8ae7Q5Yy6ZGev5Ow3GSMXiK';
//$hash2 = '$2y$10$CkWid1O2YLzaMSqN5HOUPe9lGDaLvXVmOKO5DKYKFwu9fj4MFQH8u';
//
//var_dump(password_verify($password, $hash1));
//var_dump(password_verify($password, $hash2));
