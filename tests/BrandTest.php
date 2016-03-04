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





  }
 ?>
