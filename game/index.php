<?php
require_once '../config.php';
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../login.php");
    exit;
}

function getMoney(): int {
    global $conn;
    if ($conn != null)
    {
        $sql = "SELECT money FROM users WHERE id = :username";
        $st = $conn->prepare($sql);
        $st->bindValue(":username", $_SESSION["id"], PDO::PARAM_STR);
        if ($st->execute()) {
            return $st->fetchColumn();
        }
    }
    die("Oops! Something went wrong. Please try again later.");
}
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
                        <span id="date">28-10-2000</span>
                    </div>
                </div>
            </div>
            <div class="separator watchword">
                Chess Online - Play Now!
            </div>
            <div class="content">
                <div class="welcome">
                    <p class="welcome">Welcome <?php echo htmlspecialchars($_SESSION["username"]); ?>!</p>
                    <button id="logout">Logout</button>
                </div>
                <hr>
                <div id="play">
                    <div id="start">
                        <p>
                            Public game? <input type="checkbox"></input>
                            <button>Start new</button>
                        </p>
                        <p>
                            <input placeholder="Enter friend's code"></input>
                            <button>Join in</button>
                        </p>
                    </div>
                    <div id="games">
                        <p>Public games waiting for second player:</p>
                        <ul>
                            <li>invitation_1</li>
                            <li>invitation_2</li>
                            <li>invitation_3</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="separator shop watchword">
                Customize your experience!
            </div>
            <div class="content">
                <p>Your current balance: <span id="amount"><?php echo getMoney(); ?></span></p>
                <p>TODO: shop with slider</p>
                <div class="shop">
                    <div class="slider slider-for">
                        <div><h3>1</h3></div>
                        <div><h3>2</h3></div>
                        <div><h3>3</h3></div>
                        <div><h3>4</h3></div>
                        <div><h3>5</h3></div>
                    </div>
                    <div class="slider slider-nav">
                        <div><h3>1</h3></div>
                        <div><h3>2</h3></div>
                        <div><h3>3</h3></div>
                        <div><h3>4</h3></div>
                        <div><h3>5</h3></div>
                    </div>
                </div>
            </div>
            <div id="footer">
                <hr/>
                <?php echo copyright_message() ?>
            </div>
        </div>
    </body>
</html>