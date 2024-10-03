<?php

class Loan {
    private $book;
    private $user;
    private $start_date;
    private $end_date;

    public function __construct($book,$user)
    {
        $this->book = $book;
        $this->user = $user;
        $this->start_date = null;
        $this->end_date = null;
    }

    // setters
    public function setStartDate($start_date){
        $this->start_date = $start_date;
    }
    public function setEndDate($end_date){
        $this->end_date = $end_date;
    }

    // getters
    public function getBook(){
        return $this->book;
    }
    public function getUser(){
        return $this->user;
    }
    public function getStartDate(){
        return $this->start_date;
    }
    public function getEndDate(){
        return $this->end_date;
    }

}