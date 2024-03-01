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
$connexion = databaseConnexion();
//Erreur: le script d'initialisation (creation de la base 'mydb') et la creation de l'user mysql 'myuser'
//ne fonctionne pas à l'initialisation de la base. Donc la connexion échoue pour l'instant.
var_dump($connexion);


exit;
