<?php
require_once('../config.php');
require_once('../classes/dbConn.php');
require_once('../classes/user.php');
require_once('../classes/category.php');
require_once('../classes/product.php');
require_once('../classes/file.php');
require_once('../classes/cart.php');

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: ../login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../style/game.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="../js/launcher.js"></script>
        <title>Awesome game</title>
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
                    <p class="bold">Welcome <?php echo htmlspecialchars($_SESSION['user']->username); ?>!</p>
<?php
    if (isset($_GET['action']) &&
        ($_GET['action'] == 'shop/index.php' || $_GET['action'] == 'shop/cart.php')) {
        echo '<p>Your current balance: ' . $_SESSION['user']->get_money() . '$</p>';
    }
?>
                    <p>
<?php
    if ($_SESSION["admin"]) {
        echo '<a href="../admin/index.php" class="loginbtn"><input type="submit" value="Admin page"></a>';
    }
    echo '<a href="../news.php" class="loginbtn"><input type="submit" value="Check out newsletter"></a>';
    if (isset($_GET['action']) && $_GET['action'] == 'shop/index.php') {
        echo '<a href="index.php?action=shop/cart.php" class="loginbtn"><input type="submit" value="Shopping cart"></a>';
        echo '<a href="index.php" class="loginbtn"><input type="submit" value="Return to launcher"></a>';
    } else {
        echo '<a href="index.php?action=shop/index.php" class="loginbtn"><input type="submit" value="Shop"></a>';
    }
    echo '<a href="../logout.php" class="loginbtn"><input type="submit" value="Logout"></a>';
?>
                    </p>
                </div>
            </div>