<?php

class Book
{
    private $title;
    private $author;
    public $year;
    public $status;
    private $currentBorrower;

    public function __construct($title, $author, $year, $status = true) // true = dispo
    {
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
        $this->status = $status;
        $this->currentBorrower = null;
    }

    // getters
    public function getTitle()
    {
        return $this->title;
    }
    public function getAuthor()
    {
        return $this->author;
    }
    public function getYear(){
        return $this->year;
    }
    public function getCurrentBorrower()
    {
        return $this->currentBorrower;
    }


    // retourner le statut du livre comme dispo si c'est le cas
    public function isAvailable()
    {
        return $this->status === true;
    }

    // afficher l'état du livre comme emprunté et préciser l'emprunteur
    public function isBorrowed($user)
    {
        // vérifier si le livre est déjà emprunté par utilisateur
        if ($this->currentBorrower === $user) {
            return true; // utilisateur a déjà emprunté ce livre, donc inutile de mettre à jour le statut du livre

        // sinon, changer le statut de livre à "emprunté"
        } else {
            // le livre n'est plus dispo
            $this->status = false;
            // enregistrer utilisateur comme emprunteur actuel
            $this->currentBorrower = $user;
            return false; // utilisateur vient d'emprunter ce livre et on met à jour le statut du livre
        }
    }

    // return book method
    public function isReturned()
    {
        $this->status = true;
        $this->currentBorrower = null;
    }
}
