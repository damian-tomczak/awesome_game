<?php
    include 'header.php';
    $menu = MENU::CONTACT;
    include 'nav.php';

    if($_POST) {
        $fname = "";
        $lname = "";
        $email = "";
        $region = "";
        $message = "";
        $body = "<div>";
        $recipient = "162601@student.uwm.edu.pl";
        $success = false;

        if(isset($_POST['fname'])) {
            $fname = htmlspecialchars($_POST['fname']);
            $body .= "<div><label><b>Visitor Name:</b></label>&nbsp;<span>".$fname."</span></div>";
        }

        if(isset($_POST['lname'])) {
            $lname = htmlspecialchars($_POST['lname']);
            $body .= "<div><label><b>Visitor Name:</b></label>&nbsp;<span>".$fname."</span></div>";
        }

        if(isset($_POST['email'])) {
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            $body .= "<div><label><b>Visitor Email:</b></label>&nbsp;<span>".$email."</span></div>";
        }

        if(isset($_POST['region'])) {
            $region = htmlspecialchars($_POST['region']);
            $body .= "<div><label><b>Concerned Region:</b></label>&nbsp;<span>".$region."</span></div>";
        }

        if(isset($_POST['subject'])) {
            $message = htmlspecialchars($_POST['subject']);
            $body .= "<div><label><b>Visitor Message:</b></label><div>".$message."</div></div>";
        }

        $body .= "</div>";

        $headers  = 'MIME-Version: 1.0' . "\r\n"
        .'Content-type: text/html; charset=utf-8' . "\r\n"
        .'From: ' . $email . "\r\n";

        if(mail($recipient, "Emailt sent by awsome_game's form", $body, $headers)) {
            $success = true;
        }

    }
?>
<div id="content">
    <form action="contact.php" method="post">
        <label for="fname">First Name</label>
        <input type="text" name="firstname" placeholder="Your name..">
        <label for="lname">Last Name</label>
        <input type="text" name="lastname" placeholder="Your last name..">
        <label for="lname">Email</label>
        <input type="text" name="email" placeholder="Your email address..">
        <label for="country">Region</label>
        <select id="country" name="region">
            <option value="europe">Europe</option>
            <option value="na">North America</option>
            <option value="sa">South America</option>
            <option value="asia">Asia</option>
            <option value="australia">Australia</option>
        </select>
        <label for="subject">Subject</label>
        <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
        <input type="submit" value="Submit">
        <p class="nonemail">Or send a message with your program: <a href="mailto:contact@damian-tomczak.pl">contact@damian-tomczak.pl</a></p>
    </form>
</div>
<?php
    include 'footer.php';
    if (isset($success)) {
        if ($success) {
            echo '<script>';
            echo '$(document).ready(function() {';
            echo "alert('Thank you for contacting us, $fname. You will get a reply within 24 hours.');";
            echo '});';
            echo '</script>';
        } else {
            echo '<script>';
            echo '$(document).ready(function() {';
            echo "alert('We are sorry but the email did not go through.');";
            echo '});';
            echo '</script>';
        }
    }
?>