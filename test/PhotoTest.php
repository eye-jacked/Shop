<?php
/**
 * Piotr Synowiec (c) 2016 psynowiec@gmail.com
 *
 * Date: 2016-10-18
 * Time: 15:47
 */

require_once __DIR__.'./../vendor/autoload.php';

use Shop\PhotoRepository;

class PhotoTest extends PHPUnit_Extensions_Database_TestCase
{
    static private $pdo = null;
    private $conn = null;

    final public function getConnection()
    {
        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']);
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, $GLOBALS['DB_NAME']);
        }

        return $this->conn;
    }

    protected function getDataSet()
    {
        $ds1 = $this->createFlatXmlDataSet('fixtures/photos.xml');

        $compositeDs = new PHPUnit_Extensions_Database_DataSet_CompositeDataSet();
        $compositeDs->addDataSet($ds1);

        return $compositeDs;
    }

    public function testGetAllProductPhotos()
    {
        $this->assertEquals(8, $this->getConnection()->getRowCount('product_photos'));
        $this->assertEquals(4, count(PhotoRepository::getAllProductPhotos(1)));
        $this->assertFalse(PhotoRepository::getAllProductPhotos(100));

        var_dump(PhotoRepository::getAllProductPhotos(1));
    }

    public function testGetProductPhoto()
    {
        $this->assertEquals("water_gloves1.jpg", PhotoRepository::getProductPhoto(2));
    }
}