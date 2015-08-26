<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Author.php";
    require_once "src/Book.php";

    $server = 'mysql:host=localhost;dbname=library_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BookTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Author::deleteAll();
            Book::deleteAll();
        }

        function test_getTitle()
        {
            //Arrange
            $title = "Sea Wolf";
            $due_date = "2015-09-09";
            $test_book = new Book($title, $due_date);

            //Act
            $result = $test_book->getTitle();

            //Assert
            $this->assertEquals($title, $result);
        }

        function test_getDueDate()
        {
            //Arrange
            $title = "Sea Wolf";
            $due_date = "2015-09-09";
            $test_book = new Book($title, $due_date);

            //Act
            $result = $test_book->getDueDate();

            //Assert
            $this->assertEquals($due_date, $result);
        }

        function test_getId()
        {
            //Arrange
            $title = "Sea Wolf";
            $due_date = "2015-09-09";
            $id = 1;
            $test_book = new Book($title, $due_date, $id);

            //Act
            $result = $test_book->getId();

            //Assert
            $this->assertEquals($id, $result);

        }

        function test_save()
        {
            //Arrange
            $title = "Sea Wolf";
            $due_date = "2015-09-09";
            $test_book = new Book($title, $due_date);
            $test_book->save();

            //Act
            $result = Book::getAll();

            //Assert
            $this->assertEquals($test_book, $result[0]);
        }

        function test_delete()
        {
            //Arrange
            $title = "Sea Wolf";
            $due_date = "2015-09-09";
            $test_book = new Book($title, $due_date);
            $test_book->save();

            $title2 = "Eye of the World";
            $due_date2 = "2015-10-10";
            $test_book2 = new Book($title2, $due_date2);
            $test_book2->save();

            //Act
            $test_book2->delete();
            $result = Book::getall();

            //Assert
            $this->assertEquals([$test_book], $result);
        }

        function test_getAll()
        {
            //Arrange
            $title = "Sea Wolf";
            $due_date = "2015-09-09";
            $test_book = new Book($title, $due_date);
            $test_book->save();

            $title2 = "Eye of the World";
            $due_date2 = "2015-10-10";
            $test_book2 = new Book($title2, $due_date2);
            $test_book2->save();

            //Act
            $result = Book::getALl();

            //Assert
            $this->assertEquals($test_book, $result[0]);
        }

        function test_find()
        {
            //Arrange
            $title = "Sea Wolf";
            $due_date = "2015-09-09";
            $test_book = new Book($title, $due_date);
            $test_book->save();

            $title2 = "Eye of the World";
            $due_date2 = "2015-10-10";
            $test_book2 = new Book($title2, $due_date2);
            $test_book2->save();

            //Act
            $result = Book::find($test_book->getId());

            //Assert
            $this->assertEquals($test_book, $result);    
        }
    }



?>
