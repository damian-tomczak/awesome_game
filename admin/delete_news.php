<?php
require_once '../config.php';
require '../classes/newsletter.php';
$newsletter = Newsletter::getById((int)htmlspecialchars($_GET['newsId']));
$newsletter->delete();
header( "Location: index.php?action=manage_news.php" );
?>
