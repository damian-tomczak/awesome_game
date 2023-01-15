<?php require '../classes/category.php';

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
    <?php
    $data = Category::get_list();
    $categories = $data['result'];
    $total_rows = $data['total_rows'];

    echo "<p>$total_rows news displayed</p>";
    ?>
    <hr>
    <form action="add_category.php" method="post">
        <p>Parent: <input type="text" name="parent"></p>
        <p>Name: <input type="text" name="name"></p>
        <p><input type="submit" value="Add new category"></p>
    </form>
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
                    <p><a href="delete_category.php?newsId=<? $category->id?>">Delete category</a></p>
                    <p><a href="edit_category.php?newsId=<? $category->id?>">Edit category</a></p>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</td>