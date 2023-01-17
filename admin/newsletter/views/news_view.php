<?php
$data = Newsletter::get_list();
$newsletter = $data['result'];
$total_rows = $data['total_rows'];
?>
<td colspan="2">
    <p><?= "$total_rows news displayed"; ?></p>
    <hr>
    <?php require('add_view.php') ?>
    <div class="main">
        <table>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Summary</th>
                <th>Content</th>
                <th>Publication date</th>
                <th>Image url</th>
                <th>Activated</th>
                <th>Modify</th>
            </tr>
            <?php foreach ($newsletter as $news) { ?>
            <tr>
                <td><?= $news->id ?></td>
                <td><?= $news->title ?></td>
                <td><?= $news->summary ?></td>
                <td><?= $news->content ?></td>
                <td><?= date('j F Y', $news->publication_date) ?></td>
                <td><?= $news->image_url ?></td>
                <td><?= $news->activated ? 'YES' : 'NO' ?></td>
                <td>
                    <form action=".?action=newsletter/manage_news.php&do=delete" method="POST">
                        <input type="hidden" name="id" value="<?= $news->id?>">
                        <input type="submit" value="Delete news">
                    </form>
                    <form action=".?action=newsletter/manage_news.php&do=edit_1" method="POST">
                        <input type="hidden" name="id" value="<?= $news->id?>">
                        <input type="submit" value="Edit news">
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</td>