<?php
$data = File::get_list();
$files = $data['result'];
$total_rows = $data['total_rows'];

?>
?>
<td colspan="2">
    <?= "<p>$total_rows files displayed</p>"; ?>
    <hr>
    <div class="form">
        <form action=".?action=files/manage_files.php&do=add" method="POST">
            <p>
                <label>Id:</label>
                <input type="text" name="id">
            </p>
            <p>
                <label>Mime:</label>
                <input type="text" name="mime">
            </p>
            <p>
                <label>Data:</label>
                <input type="text" name="data">
            </p>
            <p><input type="submit" value="Add new product"></p>
        </form>
    </div>
    <div class="main">
        <table>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Description</th>
                <th>Publication date</th>
                <th>Modification date</th>
                <th>Expire date</th>
                <th>Netto price</th>
                <th>Tax</th>
                <th>Availability amount</th>
                <th>Availability status</th>
                <th>Category</th>
                <th>Size</th>
                <th>File</th>
                <th>Modify</th>
            </tr>
            <?php foreach ($products as $product) { ?>
            <tr>
                <td><?= $product->id ?></td>
                <td><?= $product->title ?></td>
                <td><?= (($product->description == null) ? 'NULL' : $product->description) ?></td>
                <td><?= date('j F Y', $product->publication_date) ?></td>
                <td><?= date('j F Y', $product->modification_date) ?></td>
                <td><?= (($product->expire_date == null) ? 'NULL' : date('j F Y', $product->expire_date)) ?></td>
                <td><?= $product->netto_price ?></td>
                <td><?= $product->tax ?></td>
                <td><?= (($product->availability_amount == null) ? 'NULL' : $product->availability_amount) ?></td>
                <td><?= $product->availability_status ?></td>
                <td><?= $product->category_id ?></td>
                <td><?= (($product->size == null) ? $product->size : 'NULL') ?></td>
                <td><?= $product->file_id ?></td>
                <td>
                    <form action=".?action=products/manage_products.php&do=delete" method="POST">
                        <input type="hidden" name="id" value="<?= $product->id?>">
                        <input type="submit" value="Delete product">
                    </form>
                    <form action=".?action=category/manage_categories.php&do=edit" method="POST">
                        <input type="hidden" name="id" value="<?= $product->id?>">
                        <input type="submit" value="Edit product">
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</td>