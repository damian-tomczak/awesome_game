<?php
    include 'header.php';
    $action = isset($_GET['action']) ? htmlspecialchars($_GET['action']) : 'launcher.php';
    if (file_exists($action)) {
        require($action);
    } else {
        die('Selected page doesn\'t exist.');
    }
    include 'footer.php';
?>