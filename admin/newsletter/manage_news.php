<?php require '../classes/newsletter.php' ?>

<td colspan="2">
<?php
$results = array();
$data = Newsletter::getList();
$results['news'] = $data['results'];
$total_rows = $data['total_rows'];

echo "<p>$total_rows news displayed</p>";
?>
<hr>
<div class="center">
    <form action="add_news.php" method="post">
        <p>Title</p>
        <input type="text" name="title">
        <p>Summary</p>
        <input type="text" name="summary">
        <p>Content</p>
        <textarea name="content"></textarea>
        <p>Url</p>
        <input type="text" name="image_url">
        <p>Date</p>
        <input type="date" name="publication_date">
        <p>Activated</p>
        <input type="checkbox" name="activated">
        <p><input type="submit" value="Add new news"></p>
    </form>
</div>
<hr>
<?php
foreach ($results['news'] as $news) {
    echo "<div class=\"box\"><p><b>$news->title</b></p><p>$news->summary</p></div>";
    echo "<div class=\"box\"><a href=\"delete_news.php?newsId=$news->id\">Delete News</a></div>";
?>
    <form action="edit_news.php" method="post">
        <p>Title</p>
        <input type="text" name="title">
        <p>Summary</p>
        <input type="text" name="summary">
        <p>Content</p>
        <textarea name="content"></textarea>
        <p>Url</p>
        <input type="text" name="image_url">
        <p>Date</p>
        <input type="date" name="publication_date">
        <p>Activated</p>
        <input type="checkbox" name="activated">
        <input type="hidden" name="newsId" value=<?php echo $news->id?>>
        <p><input type="submit" value="Edit news"></p>
    </form>
<?php } ?>
</td>