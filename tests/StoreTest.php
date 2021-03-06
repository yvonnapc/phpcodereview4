<?php

/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/

  require_once "src/Store.php";
  require_once "src/Brand.php";

	$server = "mysql:host=localhost;dbname=shoes_test";
	$username = "root";
	$password = "root";
	$DB = new PDO($server, $username, $password);

  class StoreTest extends PHPUnit_Framework_TestCase
  {
    protected function tearDown()
      {
          Brand::deleteAll();
          Store::deleteAll();
      }
    function test_getName()
    {
      //Arrange
      $name = "Barney's";
      $test_store = new Store($name);
      //Act
      $result = $test_store->getName();
      //Assert
      $this->assertEquals($name, $result);
    }
    function test_getId()
    {
      //Arrange
      $name = "Barneys";
      $id = 1;
      $test_store = new Store($name, $id);
      //Act
      $result = $test_store->getId();
      //Assert
      $this->assertEquals($id, $result);
    }
    function test_save()
    {
      //Arrange
      $name = "Barneys";
      $id = null;
      $test_store = new Store($name, $id);
      //Act
      $test_store->save();
      $result = Store::getAll();
      //Assert
      $this->assertEquals([$test_store], $result);
    }
    function test_getAll()
    {
      //Arrange
      $name = "Barneys";
      $test_store = new Store($name);
      $test_store->save();

      $name2 = "Doc Martens";
      $test_store2 = new Store($name2);
      $test_store2->save();
      //Act
      $result = Store::getAll();
      //Assert
      $this->assertEquals([$test_store, $test_store2], $result);
    }
    function test_deleteAll()
    {
      //Arrange
      $name = "Barneys";
      $test_store = new Store($name);
      $test_store->save();

      $name2 = "Doc Martens";
      $test_store2 = new Store($name2);
      $test_store2->save();
      //Act
      Store::deleteAll();
      $result = Store::getAll();
      //Assert
      $this->assertEquals([], $result);
    }
    function test_find()
    {
      //Arrange
      $name = "Barneys";
      $test_store = new Store($name);
      $test_store->save();

      $name2 = "Doc Martens";
      $test_store2 = new Store($name2);
      $test_store2->save();
      //Act
      $result = Store::find($test_store->getId());
      //Assert
      $this->assertEquals($test_store, $result);
    }
    function test_addBrand()
    {
      //Arrange
      $name = "Barneys";
      $test_store = new Store($name);
      $test_store->save();

      $name = "Nike";
      $test_brand = new Brand($name);
      $test_brand->save();
      //Act
      $test_store->addBrand($test_brand);
      $result = $test_store->getBrands();
      //Assert
      $this->assertEquals([$test_brand], $result);
    }
    function test_getBrands()
    {
      //Arrange
      $name = "Barneys";
      $test_store = new Store($name);
      $test_store->save();

      $name = "Nike";
      $test_brand = new Brand($name);
      $test_brand->save();


      $name = "Adidas";
      $test_brand2 = new Brand($name);
      $test_brand2->save();

      //Act
      $test_store->addBrand($test_brand);
      $test_store->addBrand($test_brand2);
      $result = $test_store->getBrands();

      //Assert
      $this->assertEquals([$test_brand, $test_brand2], $result);
    }

  }


 ?>
