<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Patron.php";
    require_once "src/Book.php";

    $server = 'mysql:host=localhost;dbname=library_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class PatronTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Patron::deleteAll();
        }

        function test_getPatronName()
        {
            //Arrange
            $patron_name = "Hannibal";
            $test_patron = new Patron($patron_name);

            //Act
            $result = $test_patron->getPatronName();

            //Assert
            $this->assertEquals($patron_name, $result);
        }

        function test_getPatronId()
        {
            $patron_name = "Hannibal";
            $id = 1;
            $test_patron = new Patron($patron_name, $id);

            //Act
            $result = $test_patron->getId();

            //Result
            $this->assertEquals($id, $result);
        }

        function test_save()
        {
            //arrange
            $patron_name = "Hannibal";
            $test_patron = new Patron($patron_name);
            $test_patron->save();

            //Act
            $result = Patron::getAll();

            //Assert
            $this->assertEquals($test_patron, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $patron_name = "Hannibal";
            $test_patron = new Patron($patron_name);
            $test_patron->save();

            $patron_name2 = "Johnny";
            $test_patron2 = new Patron($patron_name2);
            $test_patron2->save();

            //Act
            $result = Patron::getAll();

            //Assert
            $this->assertEquals($test_patron, $result[0]);
        }
    }



?>
