<?php
$categories = Category::get_list()['result'];

/**
 * Indicates if a category has a parent category
 * 
 * @param int|null Parent category's id
 * 
 * @return bool Does the category have a parent category
 */
function has_parent(int|null $parent): bool {
    global $categories;
    foreach ($categories as $category)
    {
        if ($category->parent == $parent) {
            return true;
        }
    }
    return false;
}
/**
 * Prints layout for subcategories
 * 
 * @param int|null Parent category's id
 * 
 * @return void
 */
function recursion(int|null $parent): void {
    global $categories;
    foreach ($categories as $category)
    {
        if ($category->parent == $parent) {
            $condition = has_parent($category->id);
            echo '<li>';
            echo '<a href=".?action=shop/index.php&category_id=' .
                $category->id . '">' . $category->name . '</a>';
            if ($condition) {
                echo '<ul>';
            }
            recursion($category->id);
            if ($condition) {
                echo '</ul>';
            }
            echo '</li>';
        }
    }
}

if (isset($_POST['add_product_id'])) {
    if ($_SESSION['cart']->add(Product::get_by_id(htmlspecialchars($_POST['add_product_id'])))) {
        message('Product addeed to the cart', false);
    } else {
        message('Product already is on the list');
    }
}
?>
<div class="menu">
    <nav>
    <ul>
    <?php
        recursion(null);
    ?>
    </ul>
    </nav>
</div>
<div class="products">
    <?php
        if (isset($_GET['category_id'])) {
            $data = Product::get_by_category($_GET['category_id']);
            $products = $data['result'];
            $total_rows = $data['result_amt'];
            if ($total_rows == 0) {
                echo '<p class="bold">Selected category doesn\' have content!</p>';
                echo '<p>Please select another category.</p>';
            }
            foreach($products as $product) {
                if ($product->should_be_displayed()) {
    ?>
                <div class="product">
                    <p><a href="?action=shop/index.php&product_id=<?= $product->id ?>&category_id=<?= $_GET['category_id']?>"><?= $product->title ?></a></p>
                    <p><?= $product->get_price_with_taxes() ?>$</p>
                    <?php File::get_by_id($product->file_id)->print(75, 75) ?>
                    <?php $action = '.?action=shop/index.php&category_id=' . $_GET['category_id'] ?>
                    <form action="<?= $action ?>" method="POST">
                        <input type="hidden" name="add_product_id" value="<?= $product->id ?>">
                        <input type="submit" value="Add to cart">
                    </form>
                </div>
    <?php
                }
            }
        } else {
            echo '<p class="bold">Welcome in the shop!</p>';
            echo '<p>First select category.</p>';
        }
    ?>
</div>