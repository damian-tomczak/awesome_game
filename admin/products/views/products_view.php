<?php
$data = Product::get_list();
$products = $data['result'];
$total_rows = $data['total_rows'];
$data = Category::get_list();
$categories = $data['result'];
$data = File::get_list();
$files = $data['result'];

?>
<td colspan="2">
    <?= "<p>$total_rows products displayed</p>"; ?>
    <hr>
    <?php require 'add_view.php' ?>
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
                <td><?= $product->description != null ? $product->description : 'NULL' ?></td>
                <td><?= date('j F Y', $product->publication_date) ?></td>
                <td><?= date('j F Y', $product->modification_date) ?></td>
                <td><?= $product->expire_date != null ? date('j F Y', $product->expire_date) : 'NULL' ?></td>
                <td><?= $product->netto_price ?></td>
                <td><?= $product->tax ?></td>
                <td><?= $product->availability_amt != null ? $product->availability_amt : 'NULL' ?></td>
                <td><?= $product->availability_status ?></td>
                <td><?= $product->category_id ?></td>
                <td><?= $product->size != null ? $product->size : 'NULL' ?></td>
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