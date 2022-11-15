<?php
include 'header.php';
$menu = MENU::LOGIN;

$username = $password = $confirm_password = "";
$username_err = $password_err = $login_err = $confirm_password_err = "";
$post_action = $other_err = "";

session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    header("location: game/index.php");
}

if($_POST) {
    if (isset($_POST["register"])) {
        $post_action = "register";
        if(empty(trim($_POST["username"]))) {
            $username_err = "Please enter a username.";
        } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
            $username_err = "Username can only contain letters, numbers, and underscores.";
        } else {
            $sql = "SELECT id FROM users WHERE username = :username";
            $st = $conn->prepare($sql);
            $st->bindValue(":username", $_POST["username"], PDO::PARAM_STR);
            if ($st->execute()) {
                $other_err = "Oops! Something went wrong. Please try again later.";
            }

            if($st->rowCount() == 1) {
                $username_err = "This username is already taken.";
            } else {
                $username = trim($_POST["username"]);
            }
        }

        if(empty(trim($_POST["password"]))) {
            $password_err = "Please enter a password.";
        } elseif(strlen(trim($_POST["password"])) < 6) {
            $password_err = "Password must have atleast 6 characters.";
        } else {
            $password = trim($_POST["password"]);
        }

        if(empty(trim($_POST["confirm_password"]))) {
            $confirm_password_err = "Please confirm password.";
        } else {
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_err) && ($password != $confirm_password)) {
                $confirm_password_err = "Password did not match.";
            }
        }

        if(empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
            $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
            $st = $conn->prepare($sql);
            $st->bindValue(":username", $username, PDO::PARAM_STR);
            $st->bindValue(":password", password_hash($_POST["password"], PASSWORD_DEFAULT), PDO::PARAM_STR);
            if($st->execute()) {
                $register_success = true;
            } else{
                $other_err = "Oops! Something went wrong. Please try again later.";
            }
        }
    } elseif (isset($_POST["login"])) {
        $post_action = "login";
        if (empty(trim($_POST["username"]))) {
            $username_err = "Please enter username.";
        } else {
            $username = trim($_POST["username"]);
        }

        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter your password.";
        } else {
            $password = trim($_POST["password"]);
        }

        if (empty($username_err) && empty($password_err)) {
            $sql = "SELECT id, username, password, is_admin FROM users WHERE username = :username";
            $st = $conn->prepare($sql);
            $st->bindValue(":username", $username, PDO::PARAM_STR);
            if($st->execute()) {
                if($st->rowCount() == 1) {
                    $row = $st->fetch();
                    if (password_verify($password, $row["password"])) {
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $row["id"];
                        $_SESSION["username"] = $row["username"];
                        $_SESSION["admin"] = $row["is_admin"];
                        if ($_SESSION["admin"]) {
                            header("location: admin/index.php");
                        } else {
                            header("location: game/index.php");
                        }
                    } else {
                        $login_err = "Invalid username or password.";
                    }
                } else {
                    $login_err = "Invalid username or password.";
                }
            } else {
                $other_err = "Oops! Something went wrong. Please try again later.";
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
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>
        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password"required>
        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="confirm_password"required>
        <p>By creating an account you agree to our <a href="policy.php">Terms & Privacy</a>.</p>
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
        <p>Did you forget your password?: <a href="reset_password.php">Reset password form</a>.</p>
        <hr>
        <input type="submit" value="Login">
        <input type="hidden" name="login" value="">
    </form>
</div>
<?php
include 'footer.php';

$message = ((!empty($username_err)) ? "$username_err\\n" : "") .
    ((!empty($password_err)) ? "$password_err\\n" : "") .
    ((!empty($login_err)) ? "$login_err\\n" : "");
    ((!empty($confirm_password_err)) ? "$confirm_password_err\\n" : "");
    ((!empty($other_err)) ? "$other_err\\n" : "");
if(!empty($message)) {
    echo '<script>';
    echo '$(document).ready(function() {';
    echo "alert('Failed to $post_action due to: $message');";
    echo '});';
    echo '</script>';
}
else if ($register_success) {
    echo '<script>';
    echo '$(document).ready(function() {';
    echo "alert('Registration successfully completed\\nYou may login now!');";
    echo '});';
    echo '</script>';
}
?>