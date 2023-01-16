<?php
$data = Product::get_list();
$products = $data['result'];
$total_rows = $data['total_rows'];

?>
<td colspan="2">
    <?= "<p>$total_rows products displayed</p>"; ?>
    <hr>
    <div class="form">
        <form action=".?action=products/manage_products.php&do=add" method="POST">
            <p>
                <label>Title:</label>
                <input type="text" name="name">
            </p>
            <p>
                <label>Description:</label>
                <input type="text" name="description">
            </p>
            <p>
                <label>Publication date:</label>
                <input type="text" name="publication_date">
            </p>
            <p>
                <label>Modification date:</label>
                <input type="text" name="modification_date">
            </p>
            <p>
                <label>Expire date:</label>
                <input type="text" name="expire_date">
            </p>
            <p>
                <label>Netto price:</label>
                <input type="text" name="netto_price">
            </p>
            <p>
                <label>Tax:</label>
                <input type="text" name="tax">
            </p>
            <p>
                <label>Availability amount:</label>
                <input type="text" name="availability_amount">
            </p>
            <p>
                <label>Availability status:</label>
                <input type="text" name="Availability status">
            </p>
            <p>
                <label>Category:</label>
                <input type="text" name="category_id">
            </p>
            <p>
                <label>Size:</label>
                <input type="text" name="size">
            </p>
            <p>
                <label>File:</label>
                <input type="text" name="file">
            </p>
            <p>
                <label>Name:</label>
                <input type="text" name="name">
            </p>
            <p>
                <input type="submit" value="Add new product">
            </p>
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