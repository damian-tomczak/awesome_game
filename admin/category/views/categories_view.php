<?php
$data = Category::get_list();
$categories = $data['result'];
$total_rows = $data['total_rows'];

?>
<td colspan="2">
    <?= "<p>$total_rows categories displayed</p>"; ?>
    <hr>
    <?php require 'add_view.php' ?>
    <div class="main">
        <table>
            <tr>
                <th>Id</th>
                <th>Parent</th>
                <th>Name</th>
                <th>Modify</th>
            </tr>
            <?php foreach ($categories as $category) { ?>
            <tr>
                <td><?= $category->id ?></p>
                <td>
                    <?php
                        $parent_name = 'WITHOUT PARENT';
                        foreach ($categories as $parent) {
                            if ($parent->id == $category->parent) {
                                $parent_name = $parent->name;
                            }
                        }
                        echo $parent_name;
                    ?>
                </td>
                <td><?= $category->name ?></td>
                <td>
                    <form action=".?action=category/manage_categories.php&do=delete" method="POST">
                        <input type="hidden" name="id" value="<?= $category->id?>">
                        <input type="submit" value="Delete category">
                    </form>
                    <form action=".?action=category/manage_categories.php&do=edit" method="POST">
                        <input type="hidden" name="id" value="<?= $category->id?>">
                        <input type="submit" value="Edit category">
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</td>