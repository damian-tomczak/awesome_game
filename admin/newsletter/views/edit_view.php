<?php
$data = Newsletter::get_list();
$products = $data['result'];
?>
<td colspan="2">
    <div class="form">
        <a href=".?action=newsletter/manage_news.php" class="without-decoration">
            <input type="submit" value="Return">
        </a>
        <form action=".?action=newsletter/manage_news.php&do=edit_2" method="POST">
            <p>
                <label>Title:</label>
                <input type="text" name="title" size="50" value="<?= $selected->title ?>">
            </p>
            <p>
                <label>Summary:</label>
                <textarea name="summary" rows="4" cols="50" value="<?= $selected->summary ?>"></textarea>
            </p>
            <p>
                <label>Content:</label>
                <textarea name="content" rows="8" cols="50" value="<?= $selected->content ?>"></textarea>
            </p>
            <p>
                <label>Image url:</label>
                <input type="text" name="image_url" size="50" value="<?= $selected->image_url ?>">
            </p>
            <p>
                <label>Activated:</label>
                <input type="checkbox" name="activated" value="1" <?= $selected->activated == true ? 'checked' : '' ?>>
            </p>
            <input type="hidden" name="id" value="<?= $selected->id?>">
            <p><input type="submit" value="Edit news"></p>
        </form>
    </div>
</td>