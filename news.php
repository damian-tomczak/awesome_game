<?php
    require_once('config.php');
    require('header.php');
    $menu = MENU::NEWS;
    require('nav.php');
    require_once('classes/dbConn.php');
    require_once('classes/newsletter.php');
?>
<div id="content">
<?php
    session_start();
    $action = isset($_GET['action']) ? htmlspecialchars($_GET['action']) : '';

    switch ($action) {
    case 'view':
        show_one();
        break;
    default:
        show_all();
    }

    /**
     * Shows one news
     */
    function show_one(): void {
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
            echo '<div><a href="news.php" class="none-decoration"><input type="button" class="returnbtn" value="Return"></a></div>';
        }
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

    /**
     * Shows all news
     */
    function show_all(): void {
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
            echo '<div><a href="./game/index.php" class="none-decoration"><input type="button" class="returnbtn" value="Return"></a></div>';
        }
        $results = array();
        $data = Newsletter::get_list(DEFAULT_NUM_NEWS);
        $result['news'] = $data['result'];

        foreach ( $result['news'] as $news ) {
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