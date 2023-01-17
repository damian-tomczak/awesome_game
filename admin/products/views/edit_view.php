<?php
$data = Product::get_list();
$products = $data['result'];
?>
<td colspan="2">
    <div class="form">
        <a href=".?action=products/manage_products.php" class="without-decoration"><input type="submit" value="Return"></a>
        <form action=".?action=products/manage_products.php&do=edit_2" method="POST">
            <p>
                <label>Title:</label>
                <input type="text" name="title" value="<?= $selected->title ?>">
            </p>
            <p>
                <label>Description:</label>
                <input type="text" name="description" value="<?= $selected->description ?>">
            </p>
            <p>
                <label>Expire date:</label>
                <input type="date" name="expire_date" value="<?= $selected->expire_date ?>">
            </p>
            <p>
                <label>Netto price:</label>
                <input type="text" name="netto_price" value="<?= $selected->netto_price ?>">
            </p>
            <p>
                <label>Tax:</label>
                <input type="text" name="tax" value="<?= $selected->tax ?>">
            </p>
            <p>
                <label>Availability amount:</label>
                <input type="text" name="availability_amt" value="<?= $selected->availability_amt ?>">
            </p>
            <p>
                <label>Availability status:</label>
            </p>
            <p>
                <label>Category:</label>
            </p>
            <p>
                <label>Size:</label>
                <input type="text" name="size" value="<?= $selected->size ?>">
            </p>
            <p>
                <label>File:</label>
            </p>
            <input type="hidden" name="id" value="<?= $selected->id?>">
            <input type="hidden" name="modification_date" value="<?= strtotime('now') ?>">
            <p><input type="submit" value="Edit product"></p>
        </form>
    </div>
</td>