<?php
require_once 'config.php';
require_once 'classes/dbConn.php';
require_once 'classes/user.php';
require_once 'classes/cart.php';
include 'header.php';
$menu = MENU::LOGIN;

session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
    header('location: game/index.php');
}

if ($_POST) {
    if (isset($_POST['register'])) {
        $post_action = 'register';

        $result = User::register($_POST['email'],
            $_POST['username'],
            $_POST['password'],
            $_POST['confirm_password']);
        if (empty($result)) {
            message('Registration successfully completed\\nYou may login now!', false);
        } else {
            message(parse_array($result));
        }
    } elseif (isset($_POST["login"])) {
        $post_action = "login";
        $result = User::login($_POST['username'], $_POST['password']);
        if (gettype($result) == 'object') {
            $_SESSION["loggedin"] = true;
            $_SESSION["admin"] = $result->is_admin;
            $_SESSION["user"] = $result;
            $_SESSION["cart"] = new Cart();
            if ($_SESSION["admin"]) {
                header("location: admin/index.php");
            } else {
                header("location: game/index.php");
            }
        } else {
            message(parse_array($result));
        }
    }
}

include 'nav.php';
?>
<div id="login">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>Sing up</h1>
        <hr>
        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="email" required>
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>
        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password"required>
        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="confirm_password"required>
        <p>By creating an account you agree to our <a href="policy.php">Terms & Privacy</a></p>
        <hr>
        <input type="hidden" name="register" value="">
        <input type="submit" value="Register">
    </form>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="login">
        <h1>Sing in</h1>
        <hr>
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>
        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>
        <p>Did you forget your password? <a href="reset_password.php">Reset password form</a></p>
        <hr>
        <input type="submit" value="Login">
        <input type="hidden" name="login" value="">
    </form>
</div>
<?php include 'footer.php'; ?>