<?php

/**
 * Notre application PHP minimale.
 */

/**
 * Chargement de l'auto-loading
 */
require_once "vendor/autoload.php";
require_once './db.php';

/**
 * Déclaration du gestionnaire global d'exceptions
 */
set_exception_handler(function (Exception $e) {
    echo $e->getMessage() . "\n";
    exit;
});

//Connexion à la base de données
// $connexion = databaseConnexion();
// var_dump($connexion);

try {
    $dsn = "mysql:host=db;dbname=" . file_get_contents("/run/secrets/db_name");
    $username = file_get_contents("/run/secrets/db_user");
    $password = file_get_contents("/run/secrets/db_user_password");

    $pdo = new PDO($dsn, $username, $password);
    // Configurer PDO pour afficher les erreurs
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Votre code d'accès à la base de données va ici

} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
}

exit;
