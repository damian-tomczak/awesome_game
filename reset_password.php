<?php
    include 'header.php';
    $menu = MENU::LOGO;
    include 'nav.php';
?>
<?php
    if($_POST) {
        $fname = '';
        $lname = '';
        $email = '';
        $region = '';
        $message = '';
        $body = '<div>';
        $recipient = '162601@student.uwm.edu.pl';
        $error = '';

        if(isset($_POST['fname'])) {
            $fname = htmlspecialchars($_POST['fname']);
            $body .= "<div><label><b>Visitor Name:</b></label>&nbsp;<span>".$fname."</span></div>";
        } else {
            $error .= 'field First Name is empty\\n';
        }

        if(isset($_POST['lname'])) {
            $lname = htmlspecialchars($_POST['lname']);
            $body .= "<div><label><b>Visitor Name:</b></label>&nbsp;<span>".$fname."</span></div>";
        } else {
            $error .= 'field Last Name is empty\\n';
        }

        if(isset($_POST['email'])) {
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            $body .= "<div><label><b>Visitor Email:</b></label>&nbsp;<span>".$email."</span></div>";
        } else {
            $error .= 'field Email is empty\\n';
        }

        if(isset($_POST['region'])) {
            $region = htmlspecialchars($_POST['region']);
            $body .= "<div><label><b>Concerned Region:</b></label>&nbsp;<span>".$region."</span></div>";
        } else {
            $error .= 'field Region is empty\\n';
        }

        if(isset($_POST['subject'])) {
            $message = htmlspecialchars($_POST['subject']);
        } else {
            $error .= 'field Subject is empty\\n';
        }

        $body .= "</div>";

        $headers  = 'MIME-Version: 1.0' . "\r\n"
        .'Content-type: text/html; charset=utf-8' . "\r\n"
        .'From: ' . $email . "\r\n";

        if(!mail($recipient, "Emailt sent by awsome_game's form", $body, $headers)) {
            $error .= 'failed to send email';
        }

    }
?>
<div id="content">
    <form method="post" action="reset_password.php">
        <p><b>Enter email address to send password link</b></p>
        <input type="text" name="email" required placeholder="Enter your email address">
        <p><input type="submit" name="submit_email"></p>
    </form>
</div>
<?php
    include 'footer.php';
    if ($_POST) {
        echo '<script>';
        echo '$(document).ready(function() {';
        echo "alert('if there is an account with such an email address,",
            "you will get an email in a moment with a link to reset your password.');";
        echo '});';
        echo '</script>';
    }
?>