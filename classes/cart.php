<?php

/**
 * Support class, contained in Cart
 */
class CartItem {
    //Properties
    public $product = null;
    private $amt = null;

    /**
     * @param Product product to assoc
     */
    public function __construct(Product $product) {
        $this->product = $product;
        $this->amt = 1;
    }

    /**
     * Returns amount of products;
     * 
     * @return int Amount of products
     */
    public function get_amt(): int {
        return $this->amt;
    }

    /**
     * Increases the amount of products in cart item
     * 
     * @param ?int Optional a increase value (Default=1)
     */
    public function increase_amt(?int $value=1): void {
        $this->amt += $value;
    }

    /**
     * Decreases the amount of products in cart item
     * 
     * @param ?int Optional a decrease value (Default=1)
     * 
     * @return bool indicates a success or a failure
     */
    public function decrease_amt(?int $value=1): bool {
        if (($this->amt - $value) > 0) {
            $this->amt -= $value;
            return true;
        }
        return false;
    }
}

/**
 * Class to handle Cart functionality
 */
class Cart {
    //Properties
    /**
     * @var array Array contains cart's items
     */
    public $items = null;

    public function __construct() {
        $this->items = array();
    }

    /**
     * Clears the content of the cart
     */
    public function clear(): void {
        unset($this->items);
        $this->items = array();
    }

    /**
     * Adds product to the cart's items
     * 
     * @param Product Product to add
     * 
     * @return bool Indicates success or no
     */
    public function add(Product $product): bool {
        if (!empty($this->items)) {
            foreach($this->items as $item) {
                if ($item->product->id == $product->id) {
                    return false;
                }
            }
        }
        $this->items[] = new CartItem($product);
        return true;
    }

    /**
     * Returns the cart price with taxes
     * 
     * @return float The cart price with taxes
     */
    public function get_full_price(): float {
        $result = 0.0;
        foreach ($this->items as $item) {
            $result += $item->product->get_price_with_taxes() * $item->get_amt();
        }
        return $result;
    }

    /**
     * Returns a product by passing a id
     * 
     * @param int A product id you are looking for it in the cart
     * 
     * @return CartItem The CartItem you are looking for
     */
    public function get_item_by_product_id(int $id): CartItem|null {
        $result = null;
        foreach($this->items as $item) {
            if ($item->product->id == $id) {
                $result = $item;
            }
        }
        return $result;
    }

    /**
     * Removes a product from the cart by passing its id
     * 
     * @param int The product id you are looking for it in the cart
     * 
     * @return bool Indicates success or failure of the function
     */
    public function remove_item_by_product_id(int $id): bool {
        foreach($this->items as $key => $item) {
            if ($item->product->id == $id) {
                unset($this->items[$key]);
                return true;
            }
        }
        return false;
    }
}

?>