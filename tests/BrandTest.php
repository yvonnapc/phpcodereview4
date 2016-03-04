<?php

/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/

  require_once "src/Brand.php";

	$server = "mysql:host=localhost;dbname=shoes_test";
	$username = "root";
	$password = "root";
	$DB = new PDO($server, $username, $password);

  class BrandTest extends PHPUnit_Framework_TestCase
  {
    protected function tearDown()
      {
          Brand::deleteAll();
      }
   function test_getName()
   {
     //Arrange
     $name = "Clark's";
     $test_brand = new Brand($name);
     //Act
     $result = $test_brand->getName();
     //Assert
     $this->assertEquals($name, $result);
   }
   function test_getId()
   {
     //Arrange
     $name = "Clark's";
     $id = 1;
     $test_brand = new Brand($name, $id);
     //Act
     $result = $test_brand->getId();
     //Assert
     $this->assertEquals(true, is_numeric($result));
   }
   function test_save()
   {
     //Arrange
     $name = "Clark's";
     $id = 1;
     $test_brand = new Brand($name, $id);
     $test_brand->save();
     //Act
     $result = Brand::getAll();
     //Assert
     $this->assertEquals([$test_brand], $result);
   }
   function test_getAll()
   {
     //Arrange
     $name = "Clark's";
     $test_brand = new Brand($name);
     $test_brand->save();

     $name = "Doc Marten's";
     $test_brand2 = new Brand($name);
     $test_brand2->save();
     //Act
     $result = Brand::getAll();

     //Assert
     $this->assertEquals([$test_brand, $test_brand2], $result);
   }





  }
 ?>
