<?php
$data = Category::get_list();
$categories = $data['result'];
$total_rows = $data['total_rows'];
/**
 * Returns category's parent name
 * 
 * @param int|null Category's parent id
 * 
 * @return string|null The function returns category's parent name
 */
function parent_name(int|null $parent_id): string {
    global $categories;
    foreach ($categories as $category) {
        if ($category->id == $parent_id) {
            return $category->name;
        }
    }
    return 'WITHOUT PARENT';
}
?>
<td colspan="2">
    <?= "<p>$total_rows categories displayed</p>"; ?>
    <hr>
    <div class="form">
        <form action=".?action=category/manage_categories.php&do=add" method="POST">
            <p>
                <label>Parent:</label>
                <select name="parent">
                    <?php
                        foreach($categories as $category) {
                            echo '<option value="' . $category->id . '">' . $category->name . '</option>';
                        }
                    ?>
                </select>
            </p>
            <p>
                <label>Name:</label>
                <input type="text" name="name">
            </p>
            <p><input type="submit" value="Add new category"></p>
        </form>
    </div>
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
                <td><?= parent_name($category->parent) ?></td>
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