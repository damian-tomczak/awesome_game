<?php
    require_once 'config.php';
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: ../login.php");
        exit;
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
                        <label class="switch">
                            <input id="theme-switch" type="checkbox">
                            <span class="slider"></span>
                        </label>
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
            <div class="separator shop">
                Customize your experience!
            </div>
            <div class="content">
                <p>Your current balance: <span id="amount">666</span></p>
                <p>TODO: shop with slider</p>
            </div>
            <div id="footer">
                <hr/>
                <?php echo "&copy; 2022" . ((date('Y') != "2022") ? ("-" . date('Y')) : ("")) . " " .$_SERVER['HTTP_HOST'] ?>
            </div>
        </div>
    </body>
</html>