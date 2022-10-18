<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style/launcher.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="js/launcher.js"></script>
    </head>
    <body>
        <div class="container">
            <div id="header">
                <div id="logo">
                    <a href="#"><img src="./images/kurnik4.png" alt="Kurnik" width="232" height="29"/></a>
                </div>
                <div id="settings">
                    <div id="change-background">
                        <button class="light"></button>
                        <button class="dark"></button>
                        <button class="contrast"></button>
                    </div>
                    <div id="information">
                        LocalTime:
                        <div id="clock">12:00</div>
                        <div id="date">28-10-2000</div>
                    </div>
                </div>
            </div>
            <div id="watchword">
                Chess Online - Play Now!
            </div>
            <div id="main">
                <div id="play">
                    <div id="start">
                        <p>
                            Open game? <input type="checkbox"></input>
                            <button>Start new</button>
                        </p>
                        <p>
                            <input placeholder="Enter friend's code"></input>
                            <button>Join in</button>
                        </p>
                    </div>
                    <div id="games">
                        <p>Open games waiting for second player:</p>
                        <ul>
                            <li>invitation_1</li>
                            <li>invitation_2</li>
                            <li>invitation_3</li>
                        </ul>
                    </div>
                </div>
                <div id="shop">
                    <p>Select items:</p>
                    <p>dummy items</p>
                </div>
            </div>
            <div id="footer">
                <hr/>
                <?php echo "&copy; 2022" . ((date('Y') != "2022") ? ("-" . date('Y')) : ("")) . " " .$_SERVER['HTTP_HOST'] ?>
            </div>
        </div>
    </body>
</html>