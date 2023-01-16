<?php

/**
 * Support class, contained in Cart
 */
class CartItem {
    //Properties
    public $product = null;
    public $count = null;
}

/**
 * Class to handle Cart functionality
 */
class Cart {
    //Properties
    /**
     * @var array Array contains cart's items
     */
    private $items = null;

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
     * Returns content of the cart
     * 
     * @return array items
     */
    public function get_items(): array {
        return $this->items;
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
        $this->items[] = new CartItem($product, 0);
        return true;
    }

    /**
     * Returns the cart price with taxes
     * 
     * @return flaot The cart price with taxes
     */
    public function get_full_price(): float {
        $result = 0.0;
        foreach ($this->items as $item) {
            $result += $item->product->get_full_price();
        }
        return $result;
    }
}

?>