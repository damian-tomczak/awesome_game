<?php
    if (isset($_POST['clear_cart'])) {
        $_POST['cart']->clear();
        message("Your cart has been cleared", false);
    }
    if (isset($_POST['modify'])) {
        $selected_item = null;
        foreach($_SESSION['cart']->items as $item) {
            if ($item->product->id == $_POST['id']) {
                $selected_item = $item;
            }
        }
        if ($selected_item == null) {
            die(DEFAULT_ERROR);
        }
        if ($_POST['modify'] == 'increase') {
            $selected_item->increase_amt();
            message('Increase with success', false);
        } elseif ($_POST['modify'] == 'decrease') {
            $selected_item->decrease_amt();
            message('Decrease with success', false);
        }
    }
?>
</div>
<div class="separator second watchword">
    Shopping cart
</div>
<div class="content">
    <?php if (!empty($_SESSION['cart']->items)) {?>
    <div class="main">
        <table>
            <tr>
                <th>Product name</th>
                <th>Image</th>
                <th>Product price</th>
                <th>Amount</th>
                <th>Modify</th>
            </tr>
            <?php
                foreach($_SESSION['cart']->items as $item) {?>
            <tr>
                <td><?= $item->product->title ?></p>
                <td><?= File::get_by_id($item->product->file_id)->print(75, 75) ?></p>
                <td><?= $item->product->get_price_with_taxes() ?></td>
                <td><?= $item->get_amt() ?></td>
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
            <input type="submit" name="buy_cart" value="buy"></a>
            <input type="submit" name="clear_cart" value="Clear shopping cart">
        </form>
    </div>
    <?php } else { ?>
        <p class="bold">Your shopping cart is empty!</p>
    <?php  } ?>
</div>
