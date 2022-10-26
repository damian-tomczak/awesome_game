<?php
    include 'header.php';
    $menu = MENU::LOGIN;
    include 'nav.php';

    $username = $password = "";
    $username_err = $password_err = $login_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(empty(trim($_POST["username"]))) {
            $username_err = "Please enter username.";
        } else {
            $username = trim($_POST["username"]);
        }

        if(empty(trim($_POST["password"]))) {
            $password_err = "Please enter your password.";
        } else {
            $password = trim($_POST["password"]);
        }

        if(empty($username_err) && empty($password_err)) {
            $sql = "SELECT id, username, password FROM users WHERE username = ?";
            if($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                $param_username = $username;

                if(mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);

                    if(mysqli_stmt_num_rows($stmt) == 1) {
                        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                        if(mysqli_stmt_fetch($stmt)) {
                            if(password_verify($password, $hashed_password)) {
                                session_start();
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;
                                header("location: welcome.php");
                            } else {
                                $login_err = "Invalid username or password.";
                            }
                        }
                    } else {
                        $login_err = "Invalid username or password.";
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
                mysqli_stmt_close($stmt);
            }
        }
        mysqli_close($link);
    }
?>
<div id="login">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="registration">
        <h1>Sing up</h1>
        <hr>
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>
        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password"required>
        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat"required>
        <p>By creating an account you agree to our <a href="policy.php">Terms & Privacy</a>.</p>
        <hr>
        <input type="submit" value="Register">
    </form>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="login">
        <h1>Sing in</h1>
        <hr>
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>
        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>
        <hr>
        <input type="submit" value="Login">
    </form>
</div>
<?php include 'footer.php'?>