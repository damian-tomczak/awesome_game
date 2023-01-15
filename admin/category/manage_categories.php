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
        view();
        break;
    }
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

}

function view(): void {}
    require_once 'categories_view.php';
?>