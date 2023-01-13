<?php
    include 'header.php';
    $menu = MENU::NEWS;
    include 'nav.php';
    require 'classes/newsletter.php'
?>
<div id="content">
<?php
    session_start();
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
        echo '<div><a href="./game" class="nondecoration"><input type="button" id="backplay" value="Back to play"></a></div>';
    }
    $action = isset($_GET['action']) ? htmlspecialchars($_GET['action']) : '';

    switch ($action) {
    case 'view':
        show_one();
        break;
    default:
        show_all();
    }

    function show_one() {
        if (!isset($_GET["newsId"]) || !htmlspecialchars($_GET["newsId"])) {
            show_all();
            return;
        }

        $news = Newsletter::getById((int)htmlspecialchars($_GET["newsId"]));
        echo "<article>
                <img src=\"$news->image_url\" alt=\"image corupted\" class=\"image\"></image>
                <h1><a href=\"#\">$news->title</a></h1>
                <p><b>$news->summary</b></p>
                <p>$news->content</p>
            </article>
            <hr>";
    }

    function show_all() {
        $results = array();
        $data = Newsletter::getList(DEFAULT_NUM_NEWS);
        $results['news'] = $data['results'];

        foreach ( $results['news'] as $news ) {
            $url = $_SERVER['PHP_SELF'] . "?action=view&newsId=$news->id";
            echo "<article>
                    <img src=\"$news->image_url\" alt=\"image corupted\" class=\"image\"></image>
                    <h1><a href=\"$url\">$news->title</a></h1>
                    <p>$news->summary</p>
                </article>
                <hr>";
        }
    }
?>
</div>
<?php include 'footer.php'?>