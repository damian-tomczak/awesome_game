<!DOCTYPE html>
<html>
    <head>
        <title>Admin panel</title>
        <link rel="stylesheet" href="style/admin.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="js/admin.js" type="text/javascript"></script>
    </head>
    <body>
        <table>
            <tr id="header">
                <th id="logo">Admin panel</th>
            </tr>
            <tr>
                <td id="menu">
                    <a href="#">Dashboard</a><br>
                    <a href="#">Newsletter</a><br>
                    <a href="#">Users</a><br>
                    <a href="#">Info</a><br>
                </td>
                <td id="main" colspan="2">123123</td>
            </tr>
            <tr id="footer">
                <td colspan="3">
                    <?php echo "&copy; 2022" . ((date('Y') != "2022") ? ("-" . date('Y')) : ("")) . " " .$_SERVER['HTTP_HOST'] ?>
                </td>
            </tr>
        </table>
    </body>
</html>