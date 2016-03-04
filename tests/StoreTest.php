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
      $name = "Barney's";
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
      $name = "Barney's";
      $test_store = new Store($name);
      //Act
      $test_store->save();
      $result = Store::getAll();
      //Assert
      $this->assertEquals([$test_store], $result);
    }
    function test_getAll()
    {
      //Arrange
      $name = "Barney's";
      $test_store = new Store($name);
      $test_store->save();

      $name2 = "Doc Marten's";
      $test_store2 = new Store($name);
      $test_store2->save();
      //Act
      $result = Store::getAll();
      //Assert
      $this->assertEquals([$test_store, $test_store2], $result);
    }
    function test_deleteAll()
    {
      //Arrange
      $name = "Barney's";
      $test_store = new Store($name);
      $test_store->save();

      $name = "Doc Marten's";
      $test_store2 = new Store($name);
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
      $name = "Barney's";
      $test_store = new Store($name);
      $test_store->save();

      $name2 = "Doc Marten's";
      $test_store2 = new Store($name2);
      $test_store2->save();
      //Act
      $result = Store::find($test_store->getId());
      //Assert
      $this->assertEquals($test_store, $result);
    }

  }


 ?>
