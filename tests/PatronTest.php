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
        // protected function tearDown()
        // {
        //     Patron::deleteAll();
        // }

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
    }



?>
