<?php
require '../classes/newsletter.php';
$newsletter = Newsletter::getById( (int)$_GET['newsId']);
$newsletter->update();
header( "Location: index.php?action=manage_news.php" );
?>
