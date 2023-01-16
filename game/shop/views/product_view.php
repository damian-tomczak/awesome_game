<?php
$product = Product::get_by_id($_GET['product_id']);
?>
<p>Id</p>
<p>Title</p>
<p>Description</p>
<p>Publication date</p>
<p>Modification date</p>
<p>Expire date</p>
<p>Netto price</p>
<p>Tax</p>
<p>Availability amount</p>
<p>Availability status</p>
<p>Category</p>
<p>Size</p>
<p>File</p>
<p>Modify</p>
<a href=".?action=shop/index.php&category_id=<?= $_GET['category_id'] ?>"><input type="submit" value="Return"></a>