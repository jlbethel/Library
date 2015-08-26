<?php
    class Book
    {
        private $title;
        private $due_date;
        private $id;

//construct function

        function __construct($title, $due_date, $id = NULL)
        {
            $this->title = $title;
            $this->due_date = $due_date;
            $this->id = $id;
        }

//set functions:

        function setTitle($new_title)
        {
            $this->title = $new_title;
        }

        function setDueDate($new_due_date)
        {
            $this->due_date = $new_due_date;
        }

//Get functions:

        function getTitle()
        {
            return $this->title;
        }

        function getDueDate()
        {
            return $this->due_date;
        }

        function getId()
        {
            return $this->id;
        }

        //Delete a single book:
        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM books WHERE id = {$this->getID()};");
        }

        function save()
        {
            $GLOBALS{'DB'}->exec("INSERT INTO books (title, due_date) VALUES ('{$this->getTitle()}', '{$this->getDueDate()}');");
            $this->id = $GLOBALS ['DB']->lastInsertId();
        }
//static functions

        static function getAll()
        {
            $returned_books = $GLOBALS['DB']->query("SELECT * FROM books;");
            $books = array();
                foreach ($returned_books as $book) {
                $title = $book['title'];
                $due_date = $book['due_date'];
                $id = $book['id'];
                $new_book = new Book($title, $due_date, $id);
                array_push($books, $new_book);
            }
            return $books;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM books");
        }

        static function find($search_id)
        {
            $found_book = NULL;
            $books = Book::getAll();
            foreach ($books as $book) {
                $book_id = $book->getId();
                if ($book_id == $search_id) {
                    $found_book = $book;
                }
            }
            return $found_book;
        }

        function updateTitle($new_title)
        {
            $GLOBALS['DB']->exec("UPDATE books SET title = '{$new_title}' WHERE id = {$this->getId()};");
            $this->title = $new_title;
        }

        }
?>
