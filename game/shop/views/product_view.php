<?php
$product = Product::get_by_id($_GET['product_id']);
?>
<div class="returnbtn">
    <a href=".?action=shop/index.php&category_id=<?= $_GET['category_id'] ?>"><input type="submit" value="Return"></a>
</div>
<div>
    <p><span class="bold">Title: </span><?= $product->title ?></p>
    <p><span class="bold">Description: </span><?= $product->description != null ? $product->description : 'empty'?></p>
    <p><span class="bold">Image: </span></p>
    <p><?= File::get_by_id($product->file_id)->print(50, 50); ?></p>
    <p><span class="bold">Publication date: </span><?= $product->publication_date ?></p>
    <p><span class="bold">Modification date: </span><?= $product->modification_date ?></p>
    <p><span class="bold">Expire date: </span><?= $product->expire_date != null ? $product->expire_date : 'empty'?></p>
    <p><span class="bold">Netto price: </span><?= $product->netto_price ?>$</p>
    <p><span class="bold">Tax: </span><?= $product->tax ?>%</p>
    <p><span class="bold">Availability amount: </span><?= $product->availability_amt != null ? $product->availability_amt : 'empty' ?></p>
    <p><span class="bold">Availability status: <?= $product->availability_status ?></p>
    <p><span class="bold">Category: </span><?= Category::get_by_id($product->category_id)->name ?></p>
    <p><span class="bold">Size: </span><?= $product->size != null ? $product->size : 'empty' ?></p>
</div>