<?php

/**
 * Application PHP.
 */

require_once "vendor/autoload.php";

$db_name = getenv('MYSQL_DATABASE');
$db_user = getenv('MYSQL_USER');
$db_user_password = getenv('MYSQL_PASSWORD');


var_dump($db_user_password);

exit;