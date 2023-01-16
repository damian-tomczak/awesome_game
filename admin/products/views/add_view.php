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
                <input type="text" name="availability_amt">
            </p>
            <p>
                <label>Availability status:</label>
                <select id="country" name="availability_status">
                    <option value="true">True</option>
                    <option value="false">False</option>
                </select>
            </p>
            <p>
                <label>Category:</label>
                <select name="category_id">
                    <?php foreach($categories as $category) { ?>
                        <option value="<?= $category->id ?>"><?= $category->name ?></option>
                    <?php } ?>
                </select>
            </p>
            <p>
                <label>Size:</label>
                <input type="text" name="size">
            </p>
            <p>
                <label>File:</label>
                <select name="file_id">
                    <?php foreach($files as $file) { ?>
                        <option value="<?= $file->id ?>"><?= $file->name ?></option>
                    <?php } ?>
                </select>
            </p>
            <p>
                <input type="submit" value="Add new product">
            </p>
        </form>
    </div>