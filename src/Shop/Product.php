<?php

namespace Shop;

<<<<<<< HEAD
class Product
{
=======
class Product {
>>>>>>> e212dda92d6d7c5779edf86e401122f4813e3bc8

    private $id;
    private $name;
    private $stock;
    private $price;
    private $description;

<<<<<<< HEAD
    public function __construct($name, $stock, $price, $description, $id = null)
    {
=======
    public function __construct($name, $stock, $price, $description, $id = null) {
>>>>>>> e212dda92d6d7c5779edf86e401122f4813e3bc8
        $this->id = $id;
        $this->name = $name;
        $this->stock = $stock;
        $this->setPrice($price);
        $this->setDescription($description);
    }

<<<<<<< HEAD
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getStock()
    {
=======
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getStock() {
>>>>>>> e212dda92d6d7c5779edf86e401122f4813e3bc8
        return $this->stock;
    }

    //decrements stock
<<<<<<< HEAD
    public function boughtStock($bought)
    {
=======
    public function boughtStock($bought) {
>>>>>>> e212dda92d6d7c5779edf86e401122f4813e3bc8
        if ($this->stock >= $bought) {
            $this->stock -=$bought;
        } else {
            return false;
        }
    }

<<<<<<< HEAD
    public function getPrice()
    {
        return $this->price;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setDescription($string)
    {
        $this->description = $string;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
=======
    public function getPrice() {
        return $this->price;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setDescription($string) {
        $this->description = $string;
    }
    
    public function setId($id) {
        $this->id = $id;
    }



>>>>>>> e212dda92d6d7c5779edf86e401122f4813e3bc8
}
