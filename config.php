<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', '1');
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

define( "DB_DSN", "mysql:host=localhost;dbname=awesome_game" );
define( "DB_USERNAME", "root" );
define( "DB_PASSWORD", "" );

$conn = null;
try {
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

function copyright_message() {
    return "&copy; 2022" . ((date('Y') != "2022") ? ("-" . date('Y')) : ("")) . " " .$_SERVER['HTTP_HOST'];
}
?>
