<?php

class BookAlreadyBorrowedException extends Exception {
    public function __construct($message)
    {
        parent::__construct($message);
    }
}