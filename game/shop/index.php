<?php
$categories = Category::get_list()["result"];

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
            echo '<a href=".?action=shop/index.php&category=' . $category->id . '">' . $category->name . '</a>';
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
?>
</div>
<div class="separator second watchword">
    Shop
</div>
<div class="content">
    <?php
        if (isset($_POST['added']) && $_POST['added']) {
            echo '<p>Product addeed to the cart.</p>';
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
            if (isset($_GET['category'])) {
                $data = Product::get_by_category($_GET['category']);
                $products = $data['result'];
                $total_rows = $data['result_amt'];
                if ($total_rows == 0) {
                    echo '<p class="bold">Selected category doesn\' have content!</p>';
                    echo '<p>Please select another category.</p>';
                }
                foreach($products as $product) { ?>
                    <div class="product">
                        <p><?= $product->title ?></p>
                        <p><?= $product->get_price_with_taxes() ?>$</p>
                        <?php File::get_by_id($product->file_id)->print(75, 75) ?>
                        <?php $action = 'index.php?action=shop/index.php&category=' . $_GET['category'] ?>
                        <form action="<?= $action ?>" method="POST">
                            <input type="hidden" name="added" value="1">
                            <input type="submit" value="Add to cart">
                        </form>
                    </div>
                <?php }
            } else {
                echo '<p class="bold">Welcome in the shop!</p>';
                echo '<p>First select category.</p>';
            }
        ?>
    </div>
</div>
