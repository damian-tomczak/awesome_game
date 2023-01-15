<?php
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