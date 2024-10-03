<?php

require_once 'Person.php';
require_once 'Book.php';
require_once 'Loan.php';
require_once 'BookAlreadyBorrowedException.php';
require_once 'BookNotBorrowedException.php';

class User extends Person
{
    private $email;
    public $loans = [];

    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    //getter
    public function getName(){
        return $this->name;
    }

    public function showInfo()
    {
        echo "User name: " . $this->name . "<br/>" . "Email: " . $this->email . "<br/>" . "Borrowed books: " . implode(", ", $this->loans) . "<br /><br/>";
    }

    public function borrow($book,$start_date)
    {
        // voir d'abord si le livre est dispo
        // pas dispo
        if (!$book->isAvailable()) {

            // msg d'erreur: livre déjà emprunté exception
            throw new BookAlreadyBorrowedException($book->getTitle() .  " est déjà emprunté par " . $book->getCurrentBorrower()->name . ".");

            // dispo
        } else {
            // afficher comme emprunté et préciser l'emprunteur
            $book->isBorrowed($this);

            // créer un emprunt (dans Loan.php)
            $loan = new Loan($book, $this);
            // définir la date de départ
            $loan->setStartDate($start_date);

            // ajouter le livre (titre) sur la liste d'emprunt de l'utilisateur
            $this->loans[] = $loan;
            
            echo $book->getTitle() . " est emprunté par " . $this->name . " à cette date : " . $loan->getStartDate() . "<br /><br />";
     
        }
    }

    public function return($book,$end_date){
        // vérifier si le livre est bien emprunté
        // non, pas ce livre
        if (!$book->isBorrowed($this)) {
            // msg d'erreur
            throw new BookNotBorrowedException("Impossible de trouver " . $book->getTitle() . " dans votre liste d'emprunts.<br />");

            // oui, avec livre emprunté
        } else {
            // afficher comme retourné
            $book->isReturned($this);

            $loan = new Loan($book,$this);
            // définier la date de retour
            $loan->setEndDate($end_date);

            // supprimer le livre de la liste de livres empruntés
            $id= array_search($book->getTitle(), $this->loans);
            if ($id !== false){
                unset($this->loans[$id]);
            }

            echo $book->getTitle() . " emprunté par " . $this->name . " est retourné à cette date : " . $loan->getEndDate() . "<br /><br />";
        }
    }

}
