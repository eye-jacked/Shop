<?php

/*
  Piotr Synowiec (c) 2016 psynowiec@gmail.com
    THIS VERSION USED AND EDITED BY ROB STUGLIK.
 */

require_once __DIR__ . './../vendor/autoload.php';
use Shop\Product;
use Shop\ProductRepository;


class ProductTest extends PHPUnit_Extensions_Database_TestCase {

    static private $pdo = null;
    private $conn = null;

    final public function getConnection() {
        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']);
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, $GLOBALS['DB_NAME']);
        }
        return $this->conn;
    }

    protected function getDataSet() {
        return $this->createFlatXMLDataSet('fixtures/products.xml');
    }

    public function testGetRowCount() {
        $this->assertEquals(5, $this->getConnection()->getRowCount('products'));
    }

    public function testAddProduct() {
       $name = "apple";
       $price = "32.99";
       $stock = 10;
       $description= " a juicy green or red fruit";
       
       $apple = new Product($name, $stock, $price, $description);
       
       $this->assertTrue(ProductRepository::addProduct($apple));
    }
    
    public function testGetProductByID(){
       
        $this->assertInstanceOf(Product::class, ProductRepository::getProductById(4));
        $this->assertFalse(ProductRepository::getProductById(100));
        
    }

    public function testUpdateProduct(){
        $pr = ProductRepository::getProductById(4);
        $new = 'pear';
        $pr->setName($new);


        $this->assertTrue(ProductRepository::updateProduct($pr));

        $pr->setId(100);

        $this->assertFalse(ProductRepository::updateProduct($pr));

    }

    public function testGetProducts(){
        $pr = ProductRepository::getProducts(0,2);

        $this->assertEquals(2, count($pr), "assertion that limit argument returns 2 values");

    }

    public function testGetProducts2(){
        $pr = ProductRepository::getProducts(2,2);

        $this->assertEquals(3, $pr[0]->getId(), "assertion that offset argument returns 2 3rd product");

    }



}
