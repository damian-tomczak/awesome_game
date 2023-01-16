<?php
    require_once '../config.php';
    require_once '../classes/dbConn.php';
    require_once '../classes/user.php';
    require_once '../classes/product.php';
    require_once '../classes/category.php';
    require_once '../classes/file.php';
    require 'header.php';
    require 'menu.php';
    $action = isset($_GET['action']) ? htmlspecialchars($_GET['action']) : 'welcome.php';
    if (file_exists($action)) {
        require($action);
    } else {
        die('Selected page doesn\'t exist.');
    }
    require 'footer.php';
?>