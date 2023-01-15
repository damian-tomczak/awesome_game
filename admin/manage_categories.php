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

if (isset($_GET['do'])) {
    switch ($_GET['do']) {
    case 'add':
        add();
        break;
    case 'delete':
        delete();
        break;
    case 'edit':
        edit();
        break;
    default:
        die(DEFAULT_ERROR);
        break;
    }
}

/**
 * Helper add CMS
 */
function add(): void {

}

/**
 * Helper delete CMS
 */
function delete(): void {
    if (isset($_GET['id'])) {
        $category = Category::get_by_id($_GET['id']);
        if ($category) {
            if ($category->delete()) {
                message("Object removed", false);
            } else {
                message("Object wasn't removed");
            }
        }
    } else {
        die(DEFAULT_ERROR);
    }
}

/**
 * Helper edit CMS
 */
function edit(): void {

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
    <div class="add">
        <form action=".?action=manage_categories.php&do=add" method="POST">
            <p>
                <label>Parent:</label>
                <select name="parent">
                    <?php
                        foreach($categories as $category) {
                            echo '<option value="' . $category->id . '">' . $category->name . '</option>';
                        }
                    ?>
                    <option value=""></option>
                    <option value="fiat">Fiat</option>
                    <option value="audi">Audi</option>
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
                    <p><a href=".?action=manage_categories.php&do=delete&id=<?= $category->id?>">Delete category</a></p>
                    <p><a href=".?action=manage_categories.php&do=edit&id=<?= $category->id?>">Edit category</a></p>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</td>