<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Description.php";

    $server = 'mysql:host=localhost:8889;dbname=inventory_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class DescriptionTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
          Description::deleteAll();
        }

        function testSave()
         {
             //Arrange
             $detail = "rare copper man";
             $test_description = new Description($detail);

             //Act
             $executed = $test_description->save();

             // Assert
             $this->assertTrue($executed, "Description not successfully saved to database");
         }

         function testGetAll()
         {
             //Arrange
             $detail = "rare copper man";
             $detail_2 = "troll version";
             $test_description = new Description($detail);
             $test_description->save();
             $test_description_2 = new Description($detail_2);
             $test_description_2->save();

             //Act
             $result = Description::getAll();

             //Assert
             $this->assertEquals([$test_description, $test_description_2], $result);
         }

        // function testGetDetails()
        // {
        //     //Arrange
        //     $detail = "rare copper man";
        //     $test_description = new Description($detail);
        //
        //     //Act
        //     $result = $test_description->getDetail();
        //
        //     //Assert
        //     $this->assertEquals($detail, $result);
        // }
        function testDeleteAll()
        {
            //Arrange
            $detail = "rare copper man";
            $detail_2 = "troll version";
            $test_description = new Description($detail);
            $test_description->save();
            $test_description_2 = new Description($detail_2);
            $test_description_2->save();

            //Act
            Description::deleteAll();

            //Assert
            $result = Description::getAll();
            $this->assertEquals([], $result);
        }

        function testGetId()
        {
            //Arrange
            $detail = "rare copper man";
            $test_description = new Description($detail);
            $test_description->save();

            //Act
            $result = $test_description->getId();

            //Assert
            $this->assertTrue(is_numeric($result));
        }


        function testFind()
        {
            //Arrange
            $detail = "rare copper man";
            $detail_2 = "troll version";
            $test_description = new Description($detail);
            $test_description->save();
            $test_description_2 = new Description($detail_2);
            $test_description_2->save();

            //Act
            $id = $test_description->getId();
            $result = Description::find($id);

            //Assert
            $this->assertEquals($test_description, $result);
        }
    }

?>
