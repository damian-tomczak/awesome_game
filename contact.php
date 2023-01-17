<?php
    require_once('config.php');
    require_once('external/Exception.php');
    require_once('external/PHPMailer.php');
    require_once('external/SMTP.php');
    require_once('classes/mail.php');
    require_once('classes/user.php');
    require_once('classes/dbConn.php');
    require('header.php');
    $menu = MENU::CONTACT;
    require('nav.php');

    /**
     * Helper contact function
     * 
     * @param array Data to send
     * 
     * @return bool Indicates success or failure of the action
     */
    function contact(array $data): array {
        $fname = isset($_POST['fname']) ? htmlspecialchars($_POST['fname']) : null;
        $lname = isset($_POST['lname']) ? htmlspecialchars($_POST['lname']) : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $region = isset($_POST['region']) ? htmlspecialchars($_POST['region']) : null;
        $subject = isset($_POST['subject']) ? $_POST['subject'] : null;
        $errors = array();

        $body = '<div>';

        if ($fname) {
            $body .= "<div><label><b>Visitor First Name:</b></label>&nbsp;<span>$fname</span></div>";
        } else {
            $errors[] = 'field First Name is empty\\n';
        }

        if ($lname) {
            $body .= "<div><label><b>Visitor Last Name:</b></label>&nbsp;<span>$lname</span></div>";
        } else {
            $errors[] = 'field Last Name is empty\\n';
        }

        if ($email) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $body .= "<div><label><b>Visitor Email:</b></label>&nbsp;<span>$email</span></div>";
            } else {
                $errors[] = 'field Email is incorrect';
            }
        } else {
            $errors[] = 'field Email is empty\\n';
        }

        if($region) {
            $body .= "<div><label><b>Concerned Region:</b></label>&nbsp;<span>$region</span></div>";
        } else {
            $errors [] = 'field Region is empty\\n';
        }

        if($subject) {
            $body .= "<div><label><b>Subject:</b></label>&nbsp;<span>$subject</span></div>";
        } else {
            $errors[] = 'field Subject is empty\\n';
        }

        $body .= "</div>";

        if (!empty($errors)) {
            return $errors;
        }

        $mail = new Mailer(array('email' => "damian28102000@gmail.com", 'body' => $body,
            'subject' => "Message sended by contact form"));
        if(!$mail->send()) {
            $errors[] = "Failed to send email";
        }
        return $errors;
    }

    if (isset($_POST['send'])) {
        $result = contact($_POST);
        if (empty($result)) {
            message('Message has been sended', false);
        } else {
            message(parse_array($result));
        }
    }
?>
<div id="content">
    <form action="contact.php" method="post">
        <label for="fname">First Name</label>
        <input type="text" name="fname" placeholder="Your name.." required>
        <label for="lname">Last Name</label>
        <input type="text" name="lname" placeholder="Your last name.." required>
        <label for="lname">Email</label>
        <input type="email" name="email" placeholder="Your email address.." required>
        <label for="country">Region</label>
        <select id="country" name="region">
            <option value="europe">Europe</option>
            <option value="na">North America</option>
            <option value="sa">South America</option>
            <option value="asia">Asia</option>
            <option value="australia">Australia</option>
        </select>
        <label for="subject">Subject</label>
        <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px" required></textarea>
        <input type="submit" name="send" value="Send">
        <p class="nonemail">Or send a message with your program: <a href="mailto:contact@damian-tomczak.pl" class="darker">contact@damian-tomczak.pl</a></p>
    </form>
</div>
<?php include('footer.php'); ?>