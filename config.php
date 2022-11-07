<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', '1');
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'awesome_game');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false) {
     die("ERROR: Could not connect. " . mysqli_connect_error());
}

function copyright_message() {
    return "&copy; 2022" . ((date('Y') != "2022") ? ("-" . date('Y')) : ("")) . " " .$_SERVER['HTTP_HOST'];
}
?>
