<?php
require_once 'config.php';
require_once 'classes/dbConn.php';
require_once 'classes/user.php';
include 'header.php';
$menu = MENU::LOGIN;

$username = $password = $confirm_password = $email ='';
$username_err = $password_err = $login_err = $confirm_password_err = $email_err = '';
$post_action = $other_err = '';

session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    header("location: game/index.php");
}

if ($_POST) {
    if (isset($_POST["register"])) {
        $post_action = "register";

        if (empty(trim($_POST["email"]))) {
            $email_err = "Please enter a email.";
        } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $email_err = "Incorrect email format.";
        } else {
            $sql = "SELECT id FROM users WHERE username = :email LIMIT 1";
            $st = $conn->prepare($sql);
            $st->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
            if (!$st->execute()) {
                $other_err = "Oops! Something went wrong. Please try again later.";
            }

            if ($st->rowCount() == 1) {
                $email_err = "This email is already taken.";
            } else {
                $email = trim($_POST["email"]);
            }
        }

        if (empty(trim($_POST["username"]))) {
            $username_err = "Please enter a username.";
        } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
            $username_err = "Username can only contain letters, numbers, and underscores.";
        } else {
            $sql = "SELECT id FROM users WHERE username = :username LIMIT 1";
            $st = $conn->prepare($sql);
            $st->bindValue(":username", $_POST["username"], PDO::PARAM_STR);
            if (!$st->execute()) {
                $other_err = "Oops! Something went wrong. Please try again later.";
            }

            if ($st->rowCount() == 1) {
                $username_err = "This username is already taken.";
            } else {
                $username = trim($_POST["username"]);
            }
        }

        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter a password.";
        } elseif(strlen(trim($_POST["password"])) < 6) {
            $password_err = "Password must have atleast 6 characters.";
        } else {
            $password = trim($_POST["password"]);
        }

        if (empty(trim($_POST["confirm_password"]))) {
            $confirm_password_err = "Please confirm password.";
        } else {
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_err) && ($password != $confirm_password)) {
                $confirm_password_err = "Password did not match.";
            }
        }

        if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err)) {
            $sql = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
            $st = $conn->prepare($sql);
            $st->bindValue(":username", $username, PDO::PARAM_STR);
            $st->bindValue(":password", password_hash($_POST["password"], PASSWORD_DEFAULT), PDO::PARAM_STR);
            $st->bindValue(":email", $email, PDO::PARAM_STR);
            if($st->execute()) {
                $register_success = true;
            } else{
                $other_err = "Oops! Something went wrong. Please try again later.";
            }
        }
    } elseif (isset($_POST["login"])) {
        $post_action = "login";
        $user = User::create($_POST['username'], $_POST['password']);
        if (is_valid($user)) {
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $user->id;
            $_SESSION["username"] = $user->username;
            $_SESSION["admin"] = $user->is_admin;
            if ($_SESSION["admin"]) {
                header("location: admin/index.php");
            } else {
                header("location: game/index.php");
            }
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
<?php
include 'footer.php';
if (isset($register_success) && $register_success) {
    echo '<script>';
    echo '$(document).ready(function() {';
    echo "alert('Registration successfully completed\\nYou may login now!');";
    echo '});';
    echo '</script>';
}
?>