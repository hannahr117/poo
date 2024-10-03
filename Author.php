<?php

require_once 'Person.php';

class Author extends Person {
    public $nationality;
    public $birthdate;

    public function __construct($name,$nationality,$birthdate)
    {
        $this->name = $name;
        $this->nationality = $nationality;
        $this->birthdate = $birthdate;
    }

    // getter
    public function getName(){
        return $this->name;
    }

    public function showInfo()
    {
        echo "Author name: " . $this->name . "<br />" . "Nationality: " . $this->nationality . "<br />" . "Birthdate: " . $this->birthdate . "<br /><br />";
    }

}