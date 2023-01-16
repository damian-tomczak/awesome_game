<?php require '../classes/product.php';

$do = isset($_GET['do']) ? htmlspecialchars($_GET['do']) : '';
switch ($do) {
case 'add':
    add();
    view();
    break;
case 'delete':
    delete();
    view();
    break;
case 'edit':
    edit();
    break;
default:
    view();
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
    if (isset($_POST['id']) && !isset($_POST['name']) && !isset($_POST['parent'])) {
        $selected = Category::get_by_id($_POST['id']);
        require_once('views/edit_view.php');
    } else if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['parent'])) {
        $selected = Category::get_by_id($_POST['id']);
        $selected->parent = $_POST['parent'];
        $selected->name = $_POST['name'];
        if ($selected->update()) {
            message("Object updated", false);
        } else {
            message("Object wasn't updated");
        }
        view();
    }
    else {
        die(DEFAULT_ERROR);
    }
}

function view(): void {
    require_once 'views/products_view.php';
}
?>