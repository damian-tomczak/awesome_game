<?php
    include 'preconfig.php';
    $menu = MENU::CONTACT;
    include 'include/header.php';
?>
<div id="content">
    <form action="send_mail.php">
        <label for="fname">First Name</label>
        <input type="text" name="firstname" placeholder="Your name..">
        <label for="lname">Last Name</label>
        <input type="text" name="lastname" placeholder="Your last name..">
        <label for="lname">Email</label>
        <input type="text" name="email" placeholder="Your email address..">
        <label for="country">Country</label>
        <select id="country" name="country">
            <option value="australia">Australia</option>
            <option value="canada">Canada</option>
            <option value="usa">USA</option>
        </select>
        <label for="subject">Subject</label>
        <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
        <input type="submit" value="Submit">
        <p class="nonemail">Or send a message with your program: <a href="mailto:contact@damian-tomczak.pl">contact@damian-tomczak.pl</a></p>
    </form>
</div>
<?php include 'include/footer.php'?>