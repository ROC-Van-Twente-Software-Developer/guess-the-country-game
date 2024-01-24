<?php

// CHANGE TWO THIS FIELDS TO HAVE ACCES TO YOUR DATABASE
$user = 'bit_academy';
$pass = 'bit_academy'; 
try {
    $db = new PDO('mysql:host=localhost;dbname=guess_country_game', $user, $pass);
} catch (PDOException $e) {
    die("Something went wrong while attemping connect to gb. Did you have changed username and password in db_connection.php?");
}