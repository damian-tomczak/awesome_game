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
<div class="separator shop watchword">
    Customize your experience!
</div>
<div class="content">
    <div class="menu">
        <nav>
        <ul>
        <?php
            recursion(null);
        ?>
        </ul>
        </nav>
    </div>
    <div>
        Someting dummy.
    </div>
</div>
<!-- <div class="content">
    <p>Your current balance: <span id="amount"><?php //echo getMoney(); ?>$</span></p>
    <p>Selected color: <span id="color"></span></p>
    <div class="shop">
        <div class="slides" style="background-color:red"></div>
        <div class="slides" style="background-color:yellow"></div>
        <div class="slides" style="background-color:green"></div>
        <div class="slides" style="background-color:blue"></div>
    </div>
    <div class="buttons">
        <button onclick="plusDivs(-1)">&#10094;</button>
        <button id="select"></button>
        <button onclick="plusDivs(1)">&#10095;</button>
    </div>
</div> -->
