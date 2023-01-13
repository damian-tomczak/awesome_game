<?php
require_once '../config.php';
require '../classes/newsletter.php';
$newsletter = Newsletter::getById( (int)$_POST['newsId']);
$newsletter->title = $_POST['title'];
$newsletter->update();
header( "Location: index.php?action=manage_news.php" );
?>
