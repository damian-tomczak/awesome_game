<td colspan="2">
    <div class="form">
            <form action=".?action=category/manage_categories.php&do=edit" method="POST">
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
                    <input type="text" name="name" value="<?= $selected->name ?>">
                </p>
                <p><input type="submit" value="Edit category"></p>
            </form>
    </div>
</td>