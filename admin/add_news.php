<?php
require '../classes/newsletter.php';
$newsletter = new Newsletter;

    $newsletter->storeFormValues($_POST);
    $newsletter->insert();
    header( "Location: index.php?action=manage_news.php" );
?>