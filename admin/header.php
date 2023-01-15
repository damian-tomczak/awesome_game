<?php
    require_once '../config.php';
    session_start();
    if ($_SESSION['admin'] != true) {
        exit("Current user doesn't have permissions to see that website!");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin panel</title>
        <link rel="stylesheet" href="../style/admin.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="../js/admin.js" type="text/javascript"></script>
    </head>
    <body>
        <table>
            <tr id="header">
                <th colspan="3">
                    <div class="logo left">
                        Admin panel
                    </div>
                    <div class="logo right">
                        <a href="../game/index.php"><input type="submit" value="PlayGame"></a>
                        <a href="../logout.php"><input type="submit" value="Logout"></a>
                    </div>
                </th>
            </tr>