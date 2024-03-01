<?php

/**
 * Fonctions et valeurs donnant accès à la base de données
 */

define('MYSQL_DATABASE_SECRET_PATH', getenv('MYSQL_DATABASE'));
define('MYSQL_USER_SECRET_PATH', getenv('MYSQL_USER'));
define('MYSQL_USER_PASSWORD_SECRET_PATH', getenv('MYSQL_PASSWORD'));
//Nom d'instance du service défini dans le compose
define('MYSQL_HOST', 'db');


/**
 * Retourne les credentials d'accès à la base de données
 * @return array
 * @throws Exception - Si les credentials sont incomplets ou manquants
 */
function retrieveDbCredentials(): array
{
    if (false === file_exists(MYSQL_DATABASE_SECRET_PATH)) {
        throw new Exception("Une erreur s'est produite. Merci de rééssayer ultérieurement");
    }
    if (false === file_exists(MYSQL_USER_SECRET_PATH)) {
        throw new Exception("Une erreur s'est produite. Merci de rééssayer ultérieurement");
    }
    if (false === file_exists(MYSQL_USER_PASSWORD_SECRET_PATH)) {
        throw new Exception("Une erreur s'est produite. Merci de rééssayer ultérieurement");
    }

    $dbCredentials = [];

    $dbCredentials['db_name'] = file_get_contents(MYSQL_DATABASE_SECRET_PATH);
    $dbCredentials['db_user'] = file_get_contents(MYSQL_USER_SECRET_PATH);
    $dbCredentials['db_user_password'] = file_get_contents(MYSQL_USER_PASSWORD_SECRET_PATH);

    return $dbCredentials;
}

/**
 * Retourne une connexion à la base de données SQL
 * @throws PDOException
 */
function databaseConnexion(): PDO
{

    $dbCredentials = retrieveDbCredentials();
    $dsn = mysqlDSN(MYSQL_HOST, $dbCredentials['db_name']);
    $dsn = "mysql:host=db;dbname=" . file_get_contents("/run/secrets/db_name");

    try {

        $pdo = new PDO($dsn, $dbCredentials['db_user'], $dbCredentials['db_user_password']);
    } catch (PDOException $e) {
        throw new Exception("Une erreur s'est produite (impossible de se connecter). Merci de rééssayer ultérieurement");
    }
    return $pdo;
}

/**
 * Retourne la chaîne de connexion de MySQL
 * @return string
 */
function mysqlDSN(string $host, string $dbname): string
{
    $dsn = sprintf("mysql:host=%s;dbname=%s", $host, $dbname);
    echo $dsn;
    return $dsn;
}
