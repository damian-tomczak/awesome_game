<?php
    if (isset($_POST['clear_cart'])) {
        $_POST['cart']->clear();
        message("Your cart has been cleared", false);
    }
    if (isset($_POST['modify'])) {
        $selected = null;
        foreach($_SESSION['cart']->get_items() as $item) {
            if ($item->product->id == $_POST['id']) {
                $selected == $item;
            }
        }
        if ($selected == null) {
            die(DEFAULT_ERROR);
        }
        $selected->count++;
        if ($_POST['modify'] == 'increase') {
            message('Increase with success', false);
        } elseif ($_POST['modify'] == 'decrease') {
            message('Decrease with success', false);
        }
    }
?>
</div>
<div class="separator second watchword">
    Shopping cart
</div>
<div class="content">
    <div class="main">
        <table>
            <tr>
                <th>Product name</th>
                <th>Product price</th>
                <th>Amount</th>
                <th>Modify</th>
            </tr>
            <?php foreach($_SESSION['cart']->get_items() as $item) {?>
            <tr>
                <td><?= $item->product->title ?></p>
                <td><?= $item->product->get_full_price() ?></td>
                <td><?= $item->count ?></td>
                <td>
                    <form action=".?action=shop/cart.php" method="POST">
                        <input type="hidden" name="id" value="<?= $item->product->id ?>">
                        <input type="hidden" name="modify" value="increase">
                        <input type="submit" value="Increase amount">
                    </form>
                    <form action=".?action=shop/cart.php" method="POST">
                        <input type="hidden" name="id" value="<?= $item->product->id ?>">
                        <input type="hidden" name="modify" value="decrease">
                        <input type="submit" value="Decrease amount">
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <div>
        <p>Cart price: <?= $_SESSION['cart']->get_full_price() ?></p>
        <form action=".?action=shop/cart.php" method="POST">
            <input type="submit" name="finalize_cart" value="Finalize"></a>
            <input type="submit" name="clear_cart" value="Clear shopping cart">
        </form>
    </div>
</div>
