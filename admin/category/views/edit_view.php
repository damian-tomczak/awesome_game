<?php
$data = Category::get_list();
$categories = $data['result'];
?>
<td colspan="2">
    <div class="form">
        <a href=".?action=categories/manage_categories.php" class="without-decoration"><input type="submit" value="Return"></a>
        <form action=".?action=category/manage_categories.php&do=edit" method="POST">
            <p>
                <label>Parent:</label>
                <select name="parent">
                    <?php
                        foreach($categories as $category) {
                            echo '<option value="' . $category->id . '"' . (($selected->parent == $category->id) ? 'selected' : '') . '>' . $category->name . '</option>';
                        }
                    ?>
                </select>
            </p>
            <p>
                <label>Name:</label>
                <input type="text" name="name" value="<?= $selected->name ?>">
            </p>
            <input type="hidden" name="id" value="<?= $selected->id?>">
            <p><input type="submit" value="Edit category"></p>
        </form>
    </div>
</td>