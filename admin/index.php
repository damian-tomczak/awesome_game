<?php
    include "header.php";
    include "menu.php";
    $action = isset( $_GET['action'] ) ? $_GET['action'] : "welcome.php";
    if (file_exists($action)) {
        require($action);
    } else {
        die("Selected page doesn't exist.");
    }
    include "footer.php"
?>