<?php
    include 'preconfig.php';
    $menu = MENU::CONTACT;
    include 'include/header.php';
?>
<div id="login">
    <form action="register.php">
        <div class="container">
            <h1>Sing up</h1>
            <hr>
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" id="email" required>
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
            <label for="psw-repeat"><b>Repeat Password</b></label>
            <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>
            <hr>
            <p>By creating an account you agree to our <a href="policy.php">Terms & Privacy</a>.</p>
            <input type="submit" value="Register">
        </div>
    </form>
    <form action="login.php">
        <div class="container">
            <h1>Sing in</h1>
            <hr>
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" id="email" required>
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
            <hr>
            <input type="submit" value="Login">
        </div>
    </form>
</div>
<?php include 'include/footer.php'?>