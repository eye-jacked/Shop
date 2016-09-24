<?php

/*
  Piotr Synowiec (c) 2016 psynowiec@gmail.com
 */

require_once __DIR__ . './../vendor/autoload.php';

function UsersTmpl($array) {
    var_dump($array);
    $xml = <<<XML
     <users
            id="{$array[0]}"
            fname="{$array[1]}"
            lname="{$array[2]}"
            email="{$array[3]}"
            password="{$array[4]}"
            address="{$array[5]}"/>
XML;
    return $xml;
}

$faker = Faker\Factory::create();
$gender = array('male', 'female');

$xmlFile = 'fake-users.xml';
$handle = fopen($xmlFile, "w");

$xmlHead = '<?xml version="1.0" ?>' . PHP_EOL;


fwrite($handle, $xmlHead);
fwrite($handle, '<dataset>' . PHP_EOL);


for ($i = 0; $i < 20; $i++) {
    if ($i % 2 == 0) {
        $g = $gender[0];
    } else {
        $g = $gender[1];
    }
    $fn = $faker->firstName($g);
    $ln = $faker->lastName($g);
    $em = $faker->freeEmail;
    $hp = password_hash(strtolower($fn), PASSWORD_BCRYPT);
    $ad = $faker->address;
    $uA = array($i + 1, $fn, $ln, $em, $hp, $ad);
    var_dump($uA);

    fwrite($handle, UsersTmpl($uA) . PHP_EOL);
}

fwrite($handle, '</dataset>' . PHP_EOL);
fclose($handle);
