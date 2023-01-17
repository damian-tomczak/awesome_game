<?php
    require_once('config.php');
    require_once('external/Exception.php');
    require_once('external/PHPMailer.php');
    require_once('external/SMTP.php');
    require_once('classes/mail.php');
    require_once('classes/user.php');
    require_once('classes/dbConn.php');
    include 'header.php';
    $menu = MENU::LOGO;
    include 'nav.php';
?>
<?php
    function reset_password(string $email): bool {
        if ($email) {
            $pwd = User::reset_password($_POST['email']);
            if ($pwd) {
                $body = "<div>Your new password: $pwd</div>";
                $mail = new Mailer(array('email' => $_POST['email'], 'body' => $body, 'subject' => "New password"));
                if($mail->send()) {
                    return true;
                }
            }
        }
        return false;
    }
    if(isset($_POST['send_email'])) {
        $email = isset($_POST['email']) ?? null;
        if (reset_password($email)) {
            message('Password/s sended', false);
        } else {
            message(DEFAULT_ERROR);
        }
    }
?>
<div id="content">
    <form action="reset_password.php" method="POST">
        <p><b>Enter email address to send password link</b></p>
        <input type="text" name="email" required placeholder="Enter your email address">
        <p><input type="submit" name="send_email" value="Reset password"></p>
    </form>
</div>
<?php
    include 'footer.php';
?>