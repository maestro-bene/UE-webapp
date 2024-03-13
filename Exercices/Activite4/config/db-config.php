<?php

// Configuration de la base de données
define('DB_SERVER', 'localhost');   // Adresse du serveur de base de données
define('DB_USERNAME', 'root'); // Nom d'utilisateur pour se connecter
define('DB_PASSWORD', 'root');    // Mot de passe pour se connecter
define('DB_NAME', 'citation_db'); // Nom de la base de données

// Tentative de connexion à la base de données MySQL
try {
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Configuration du mode d'erreur PDO sur exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("ERREUR : Impossible de se connecter. " . $e->getMessage());
}

// Return the PDO object for use in other files
return $pdo;
