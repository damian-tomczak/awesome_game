<?php
require_once "../config.php";
require "../classes/shop.php";
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: ../login.php');
    exit;
}
// function getMoney(): int {
//     global $conn;
//     if ($conn)
//     {
//         $sql = "SELECT money FROM users WHERE id = :username LIMIT 1";
//         $st = $conn->prepare($sql);
//         $st->bindValue(":username", $_SESSION["id"], PDO::PARAM_STR);
//         if ($st->execute()) {
//             return $st->fetchColumn();
//         }
//     }
//     die("Oops! Something went wrong. Please try again later.");
// }

// $sql = "SELECT colors.name FROM user_colors INNER JOIN colors ON colors.id = user_colors.color_id INNER JOIN users ON users.id = user_colors.user_id WHERE users.id = :id LIMIT 1";
// if ($conn) {
//     $st = $conn->prepare($sql);
//     $st->bindValue(":id", $_SESSION["id"], PDO::PARAM_INT);
//     if($st->execute()) {
//         while ($row = $st->fetch()) {
//             $result[] = $row["name"];
//         }
//     } else{
//         die("Oops! Something went wrong. Please try again later.");
//     }
//     echo '<script type=\'text/javascript\'>';
//     $result[] = "red";
//     $js_array = json_encode($result);
//     echo "var av_colors = ". $js_array . ";\n";
//     echo '</script>';
// }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../style/launcher.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="../js/launcher.js"></script>
    </head>
    <body>
        <div class="container">
            <div id="header">
                <div id="logo">
                    <a href="#"><img src="../images/logo.png" alt="Logo" width="120" height="120"/></a>
                </div>
                <div id="settings">
                    <div id="change-background">
                        <input id="theme-switch" type="checkbox">
                    </div>
                    <div id="information">
                        <span id="clock">12:00:00</span><br>
                        <span id="date">28-10-20</span>
                    </div>
                </div>
            </div>
            <div class="separator watchword">
                Chess Online - Play Now!
            </div>
            <div class="content">
                <div class="welcome">
                    <p>Welcome <?php echo htmlspecialchars($_SESSION["username"]); ?>!</p>
                    <?php
                        if ($_SESSION["admin"]) {
                            echo '<p><a href="../admin/index.php">redirect to admin page</p>';
                        }
                        echo '<p><a href="../news.php">Check out newsletter</a></p>';
                        if (isset($_GET['action']) && $_GET['action'] == 'shop/index.php') {
                            echo '<p><a href="index.php">Back to launcher</a></p>';
                        } else {
                            echo '<p><a href="index.php?action=shop/index.php">Customize your experience</a></p>';
                        }                    ?>
                    <button id="logout">Logout</button>
                </div>