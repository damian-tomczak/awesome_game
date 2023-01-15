<?php require '../classes/category.php';

$do = isset($_GET['do']) ? htmlspecialchars($_GET['do']) : '';
switch ($do) {
case 'add':
    add();
    require_once 'categories_view.php';
    break;
case 'delete':
    delete();
    require_once 'categories_view.php';
    break;
case 'edit':
    edit();
    break;
default:
    require_once 'categories_view.php';
    break;
}

/**
 * Helper add CMS
 */
function add(): void {
    if (isset($_POST['name']) && isset($_POST['parent'])) {
        $category = new Category;
        $category->store_form_values($_POST);
        if ($category->insert()) {
            message("The category added", false);
        } else {
            message("Couldn't add the category");
        }
    } else {
        die(DEFAULT_ERROR);
    }
}

/**
 * Helper delete CMS
 */
function delete(): void {
    if (isset($_POST['id'])) {
        $category = Category::get_by_id($_POST['id']);
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
    if (isset($_POST['id'])) {
        $selected = Category::get_by_id($_POST['id']);
        require_once('edit_view.php');
    } else {
        die(DEFAULT_ERROR);
    }
}
?>