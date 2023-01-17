<?php
    if (isset($_POST['clear_cart'])) {
        $_SESSION['cart']->clear();
        message("Your shopping cart has been cleared", false);
    }
    if (isset($_POST['increase']) || isset($_POST['decrease'])) {
        $selected_item = $_SESSION['cart']->get_item_by_product_id($_POST['id']);
        if ($selected_item === null) {
            die(DEFAULT_ERROR);
        }
        if (isset($_POST['increase'])) {
            $selected_item->increase_amt();
            message('Shopping cart updated', false);
        } elseif (isset($_POST['decrease'])) {
            if ($selected_item->decrease_amt()) {
                message('Shopping cart updated', false);
            } else {
                message('Shopping cart couldn\' be updated');
            }
        }
    } elseif (isset($_POST['delete'])) {
        if ($_SESSION['cart']->remove_item_by_product_id($_POST['id'])) {
            message('Shopping cart updated', false);
        } else {
            message('Shopping cart couldn\' be updated');
        }
    } elseif (isset($_POST['buy_cart'])) {
        $after_bought = $_SESSION['user']->get_money() - $_SESSION['cart']->get_full_price();
        if ($after_bought > 0) {
            $_SESSION['user']->decrease_money($_SESSION['cart']->get_full_price());
            $_SESSION['cart']->clear();
            message('You have bought cart\'s content', false);
            header('Location: .?action=shop/cart.php');
        } else {
            message('You don\' have enough money');
        }
    }
?>
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
                        <input type="submit" name="increase" value="Increase amount">
                    </form>
                    <form action=".?action=shop/cart.php" method="POST">
                        <input type="hidden" name="id" value="<?= $item->product->id ?>">
                        <input type="submit" name="decrease" value="Decrease amount">
                    </form>
                    <form action=".?action=shop/cart.php" method="POST">
                        <input type="hidden" name="id" value="<?= $item->product->id ?>">
                        <input type="submit" name="delete" value="Delete item">
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <div>
        <p>Cart price: <?= $_SESSION['cart']->get_full_price() ?></p>
        <form action=".?action=shop/cart.php" method="POST">
            <input type="submit" name="buy_cart" value="Buy"></a>
            <input type="submit" name="clear_cart" value="Clear shopping cart">
        </form>
    </div>
    <?php } else { ?>
        <p class="bold">Your shopping cart is empty!</p>
    <?php  } ?>
</div>
