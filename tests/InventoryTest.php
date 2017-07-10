<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Inventory.php";

    $server = 'mysql:host=localhost:8889;dbname=inventory_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class CollectibleTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Collectible::deleteAll();
        }

        function test_save()
        {
            //Arrange
            $item = "Coins";
            $test_collectible = new Collectible($item);

            //Act
            $executed = $test_collectible->save();

            // Assert
            $this->assertTrue($executed, "Collectible not successfully saved to database");
        }

        function testGetAll()
        {
            //Arrange
            $item = "Coins";
            $item_2 = "Barbies";
            $test_collectible = new Collectible($item);
            $test_collectible->save();
            $test_collectible_2 = new Collectible($item_2);
            $test_collectible_2->save();

            //Act
            $result = Collectible::getAll();

            //Assert
            $this->assertEquals([$test_collectible, $test_collectible_2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $item = "Coins";
            $item_2 = "Barbies";
            $test_collectible = new Collectible($item);
            $test_collectible->save();
            $test_collectible_2 = new Collectible($item_2);
            $test_collectible_2->save();

            //Act
            Collectible::deleteAll();

            //Assert
            $result = Collectible::getAll();
            $this->assertEquals([], $result);
        }
    }
?>
