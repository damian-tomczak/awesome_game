<div class="separator second watchword">
    Shop
</div>
<div class="content">
    <?php
        if (isset($_GET['product_id'])) {
            require('views/product_view.php');
        } else {
            require('views/products_view.php');
        }
    ?>
</div>
