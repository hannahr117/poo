<?php

require_once 'Book.php';
require_once 'Person.php';
require_once 'User.php';
require_once 'Author.php';
require_once 'BookAlreadyBorrowedException.php';

// Création des objets
$book1 = new Book("Dune","Frank Herbert","1965");
$book2 = new Book("Foundation","Isaac Asimov","1951");
$book3 = new Book("Harry Potter","JK Rowling","1997");

$author1 = new Author("Dan Brown","Américain","22-06-1964");
$author2 = new Author("Frank Herbert","Américain","08-10-1920");
$author3 = new Author("Isaac Asimov","Américain","02-01-1920");
$author4 = new Author("JK Rowling","Britannique","31-07-1965");

$user1 = new User("John Doe","johndoe@gmail.com");
$user2 = new User("Mary Poppins", "mary@nounou.com");

// emprunter un livre
echo "<p><b>Historique des emprunts :</b></p>";
$user1->borrow($book1,"24-04-2024");
$user2->borrow($book2,"14-8-2024");
$user1->return($book1,"26-05-2024");
$user2->borrow($book1,"27-5-2024");

// essayez d'emprunter des livres déjà empruntés
// utilisez des blocs try/catch pour capturer les erreurs d'emprunt
echo "<p><b>Message d'erreur quand un utilisateur essaye d'emprunter un livre non dispo :</b></p>";
try {
    $user2->borrow($book1,"25-04-2024");
} catch (BookAlreadyBorrowedException $e) {
    echo "Erreur : " . $e->getMessage() . "<br />";
}

// un utilisateur tente de retourner un livre qui n'a pas emprunté
echo "<p><b>Message d'erreur quand un utilisateur essaye de retourner un livre qui n'a pas emprunté :</b></p>";
try {
    $user1->return($book2,"14-02-2024");
} catch (BookNotBorrowedException $e) {
    echo "Erreur : " . $e->getMessage() .  "<br />";
}

// Affichage de la liste des livres
$books = [$book1,$book2,$book3];
echo "<h1>Liste des Livres</h1>";
echo "<ul>";
// Parcourez les livres et affichez leurs informations (titre, auteur, statut)
foreach ($books as $book) {
    echo "<li>" . $book->getTitle() . " - " . $book->getAuthor() . " (" . $book->getYear() . ")";
    if ($book->getCurrentBorrower()) {
        echo " <strong>(Emprunté)</strong>";
    } else {
        echo " <strong>(Disponible)</strong>";
    }
    echo "</li>";
}
echo "</ul>";

// Affichage de la liste des auteurs
$authors = [$author1,$author2,$author3,$author4];
echo "<h2>Liste des Auteurs</h2>";
echo "<ul>";
// Parcourez les auteurs et affichez leurs informations (nom, nationalité, date de naissance)
foreach ($authors as $author) {
    echo "<li>" . $author->getName() . " - " . $author->nationality . " (Né le " . $author->birthdate . ")</li>";
}
echo "</ul>";

// Affichage de la liste des emprunts
// récupérer la liste Loans
$loans = [];
$users = [$user1,$user2];
foreach ($users as $user){
    $loans = array_merge($loans,$user->loans);
}
echo "<h2>Liste des Emprunts</h2>";

if (empty($loans)){
    echo "<p>Aucun emprunt actuellement.</p>";
} else {
    echo "<ul>";
// Parcourez les emprunts et affichez les informations (livre emprunté, utilisateur, date d'emprunt)
foreach ($loans as $loan) {
    $book = $loan->getBook();
    $user = $loan->getUser();
    $date = $loan->getStartDate();

    echo "<li>";
    echo $book->getTitle() . " - emprunté par " . $user->getName() . " depuis le " . $date;

    echo "</li>";
}
echo "</ul>";
}

