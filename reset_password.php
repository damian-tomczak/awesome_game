<?php
    require_once('external/Exception.php');
    require_once('external/PHPMailer.php');
    require_once('external/SMTP.php');
    require_once('classes/mail.php');
    include 'header.php';
    $menu = MENU::LOGO;
    include 'nav.php';
?>
<?php
    if(isset($_POST['send_mail'])) {
        $recipient = 'contact@damian-tomczak.pl';
        $error = '';

        if(isset($_POST['email'])) {
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

        $mail = new Mailer(array('email' => $_POST['email'], 'body' => $body, 'subject' => $subject));
        if(mail($recipient, "Emailt sent by awsome_game's form", $body, $headers)) {
            message('Password/s sended', false);
        } else {
            message(DEFAULT_ERROR);
        }

    }
?>
<div id="content">
    <form method="post" action="reset_password.php">
        <p><b>Enter email address to send password link</b></p>
        <input type="text" name="email" required placeholder="Enter your email address">
        <p><input type="submit" name="send_email"></p>
    </form>
</div>
<?php
    include 'footer.php';
?>