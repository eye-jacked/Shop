<?php

namespace Shop;

class Product
{

    private $id;
    private $name;
    private $stock;
    private $price;
    private $description;

    public function __construct($name, $stock, $price, $description, $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->stock = $stock;
        $this->setPrice($price);
        $this->setDescription($description);
    }

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
        return $this->stock;
    }

    //decrements stock
    public function boughtStock($bought)
    {
        if ($this->stock >= $bought) {
            $this->stock -=$bought;
        } else {
            return false;
        }
    }

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
}
