<?php
    include 'preconfig.php';
    $menu = MENU::LOGIN;
    include 'header.php';
?>
<div id="login">
    <form action="register.php">
        <h1>Sing up</h1>
        <hr>
        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw"required>
        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat"required>
        <p>By creating an account you agree to our <a href="policy.php">Terms & Privacy</a>.</p>
        <hr>
        <input type="submit" value="Register">
    </form>
    <form action="login.php">
        <h1>Sing in</h1>
        <hr>
        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>
        <hr>
        <input type="submit" value="Login">
    </form>
</div>
<?php include 'footer.php'?>