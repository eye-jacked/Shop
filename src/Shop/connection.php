<?php

/*
  Piotr Synowiec (c) 2016 psynowiec@gmail.com
 */



$configDB = array(
    'servername' => "localhost",
    'username' => "root",
    'password' => "root",
    'baseName' => "cl_shop"
);


$pdo = null;

try {
    $pdo = new PDO('mysql:host=' . $configDB['servername'] . ';dbname=' . $configDB['baseName'], $configDB['username'], $configDB['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stm = $pdo->prepare('SELECT * FROM poll');
    $stm->execute();
    $res = $stm->fetchAll();
    var_dump($res);
} catch (PDOException $e) {
    echo 'PDO Error: ' . $e->getMessage();
}

var_dump($pdo);
//setting connections for Models
Poll::SetConnection($pdo);
?>

