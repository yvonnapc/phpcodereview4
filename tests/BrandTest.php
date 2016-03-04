<?php

/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/

  require_once "src/Brand.php";

	$server = "mysql:host=localhost;dbname=shoe_test";
	$username = "root";
	$password = "root";
	$DB = new PDO($server, $username, $password);

  class BrandTest extends PHPUnit_Framework_TestCase
  {






  }
 ?>
