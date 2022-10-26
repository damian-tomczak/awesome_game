<nav class="topnav">
    <a href="login.php" class="<?php isEnable($menu, MENU::LOGIN)?> text">Login</a>
    <a href="news.php" class="<?php isEnable($menu, MENU::NEWS)?> text">Newsletter</a>
    <a id="logo" href="index.php"><img id="logo" src="images/logo.png"></img></a>
    <a href="info.php" class="<?php isEnable($menu, MENU::INFO)?> text">Description</a>
    <a href="contact.php" class="<?php isEnable($menu, MENU::CONTACT)?> text">Contact</a>
</nav>