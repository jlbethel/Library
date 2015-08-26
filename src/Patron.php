<?php

    class Patron
    {
        private $patron_name;
        private $id;

        function __construct($patron_name, $id = NULL)
        {
            $this->patron_name = $patron_name;
            $this->id = $id;
        }

        //Set method
        function setPatronName($new_patron_name)
        {
            $this->patron_name = $new_patron_name;
        }

        //Get methods
        function getPatronName()
        {
            return $this->patron_name;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO patrons (patron_name) VALUES ('{$this->getPatronName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_patrons = $GLOBALS['DB']->query("SELECT * FROM patrons;");
            $patrons = array();
            foreach($returned_patrons as $patron) {
                $patron_name = $patron['patron_name'];
                $id = $patron['id'];
                $new_patron = new Patron($patron_name, $id);
                array_push($patrons, $new_patron);
            }
            return $patrons;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM patrons");
        }

        static function find($search_id)
        {
            $found_patron = NULL;
            $patrons = Patron::getAll();
            foreach ($patrons as $patron) {
                $patron_id = $patron->getId();
                if ($patron_id == $search_id) {
                    $found_patron = $patron;
                }
            }
            return $found_patron;
        }

    }
 ?>
