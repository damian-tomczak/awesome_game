<div class="form">
    <form action=".?action=category/manage_categories.php&do=add" method="POST">
        <p>
            <label>Parent:</label>
            <select name="parent">
                <?php
                    foreach($categories as $category) {
                        echo '<option value="' . $category->id . '">' . $category->name . '</option>';
                    }
                ?>
            </select>
        </p>
        <p>
            <label>Name:</label>
            <input type="text" name="name">
        </p>
        <p><input type="submit" value="Add new category"></p>
    </form>
</div>