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
enum Menu {
    case LOGIN;
    case NEWS;
    case LOGO;
    case INFO;
    case CONTACT;
}

function isEnable(Menu $menu, Menu $expected) {
    if (isset($menu) && ($menu == $expected)) {
        echo 'active';
    }
}
?>
