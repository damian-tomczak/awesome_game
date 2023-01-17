<?php
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
case 'edit_1':
    edit_1();
    break;
case 'edit_2':
    edit_2();
    break;
default:
    view();
    break;
}

/**
 * Helper add CMS
 */
function add(): void {
    $news = new Newsletter();
    $news->store_form_values($_POST);
    if ($news->insert()) {
        message("The object added", false);
    } else {
        message("Couldn't add the object");
    }
}

/**
 * Helper delete CMS
 */
function delete(): void {
    if (isset($_POST['id'])) {
        $product = Newsletter::get_by_id($_POST['id']);
        if ($product) {
            if ($product->delete()) {
                message("Object removed", false);
            } else {
                message("Object wasn't removed");
            }
        }
    }
}

/**
 * Helper edit CMS
 */
function edit_1(): void {
    if (isset($_POST['id'])) {
        $selected = Newsletter::get_by_id($_POST['id']);
        require_once('views/edit_view.php');
    }
}

/**
 * Helper edit CMS
 */
function edit_2(): void {
    $selected = Newsletter::get_by_id($_POST['id']);
    $selected->store_form_values($_POST, false);
    if ($selected->update()) {
        message("Object updated", false);
    } else {
        message("Object wasn't updated");
    }
    view();
}


/**
 * Help view CMS
 */
function view(): void {
    require_once('views/news_view.php');
}
?>