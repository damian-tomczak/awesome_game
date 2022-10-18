<?php require_once 'config.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Awesome game</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Titillium Web">
    <link rel="stylesheet" href="style/welcome.css">
    <meta name="description" content="Awesome game description">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="js/welcome.js"></script>
</head>
<body>
    <div class="container">
        <nav class="topnav">
            <a href="login.php" class="<?php isEnable($menu, MENU::LOGIN)?> text">Login</a>
            <a href="news.php" class="<?php isEnable($menu, MENU::NEWS)?> text">Newsletter</a>
            <a id="logo" href="index.php"><img id="logo" src="images/logo.png"></img></a>
            <a href="info.php" class="<?php isEnable($menu, MENU::INFO)?> text">Description</a>
            <a href="contact.php" class="<?php isEnable($menu, MENU::CONTACT)?> text">Contact</a>
        </nav>