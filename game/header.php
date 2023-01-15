<?php
require_once "../config.php";
require "../classes/shop.php";
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: ../login.php');
    exit;
}


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
        <link rel="stylesheet" href="../style/game.css">
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
                    <p>
                        Welcome <?php echo htmlspecialchars($_SESSION["username"]); ?>!
                        <?php
                            if (isset($_GET['action']) && $_GET['action'] == 'shop/index.php') {
                                
                            }
                        ?>
                    </p>
                    <p>
                        <?php
                            if ($_SESSION["admin"]) {
                                echo '<a href="../admin/index.php" class="loginbtn"><input type="submit" value="Admin page"></a>';
                            }
                            echo '<a href="../news.php" class="loginbtn"><input type="submit" value="Check out newsletter"></a>';
                            if (isset($_GET['action']) && $_GET['action'] == 'shop/index.php') {
                                echo '<a href="index.php" class="loginbtn"><input type="submit" value="Return to launcher"></a>';
                            } else {
                                echo '<a href="index.php?action=shop/index.php" class="loginbtn"><input type="submit" value="Shop"></a>';
                            }
                            echo '<a href="../logout.php" class="loginbtn"><input type="submit" value="Logout"></a>';
                        ?>
                    </p>
                </div>