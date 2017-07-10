<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Description.php";

    $server = 'mysql:host=localhost:8889;dbname=to_do_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class DescriptionTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
          Description::deleteAll();
        }

        function testGetDetails()
        {
            //Arrange
            $detail = "rare copper man";
            $test_description = new Description($detail);

            //Act
            $result = $test_description->getDetails();

            //Assert
            $this->assertEquals($detail, $result);
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

        function testGetId()
        {
            //Arrange
            $detail = "rare copper man";
            $test_description = new Description($detail);
            $test_description->save();

            //Act
            $result = $test_description->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
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
            $result = Description::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function testFind()
        {
            //Arrange
            $detail = "rare copper man";
            $detail2 = "troll version";
            $test_description = new Description($detail);
            $test_description->save();
            $test_description_2 = new Description($detail2);
            $test_description_2->save();

            //Act
            $result = Description::find($test_description->getId());

            //Assert
            $this->assertEquals($test_description, $result);
        }
    }

?>
