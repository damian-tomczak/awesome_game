<?php
/**
 * Class to handle products
 */
class Product {
    // Properties
    /**
     * @var int product id
     */
    public $id = null;
    /**
     * @var string product title
     */
    public $title = null;
    /**
     * @var string product description
     */
    public $description = null;
    /**
     * @var int date of publication
     */
    public $publication_date = null;
    /**
     * @var int date of modification
     */
    public $modification_date = null;
    /**
     * @var int date of expiration
     */
    public $expire_date = null;
    /**
     * @var float product netto price
     */
    public $netto_price = null;
    /**
     * @var float product tax price
     */
    public $tax = null;
    /**
     * @var int products amount
     */
    public $availability_amount = null;
    /**
     * @var bool product availability status
     */
    public $availability_status = null;
    /**
     * @var int  product category id
     */
    public $category_id = null;
    /**
     * @var int product size
     */
    public $size = null;
    /**
     * @var File product image file
     */
    public $file_id = null;

    /**
     * Sets the object's properties using the values in the supplied array
     *
     * @param assoc The property values
     */
    public function __construct(array $data) {
        if (isset($data['id'] )) $this->id = (int) $data['id'];
        if (isset($data['title'])) $this->title = $data['title'];
        if (isset($data['description'])) $this->description = $data['description'];
        if (isset($data['publication_date'])) $this->publication_date = $data['publication_date'];
        if (isset($data['modification_date'])) $this->modification_date = $data['modification_date'];
        if (isset($data['expire_date'])) $this->expire_date = $data['expire_date'];
        if (isset($data['netto_price'])) $this->netto_price = $data['netto_price'];
        if (isset($data['tax'])) $this->tax = $data['tax'];
        if (isset($data['availability_amount'])) $this->availability_amount = $data['availability_amount'];
        if (isset($data['availability_status'])) $this->availability_status = $data['availability_status'];
        if (isset($data['category_id'])) $this->category_id = $data['category_id'];
        if (isset($data['size'])) $this->size = $data['size'];
        if (isset($data['file_id'])) $this->file_id = $data['file_id'];
    }

    /**
     * Return list of products
     * 
     * @param int Optional number of categories to get
     * 
     * @return array Array of categories and the number of categories
     */
    public static function get_list(?int $numRows=1000000): array {
        $conn = DBConn::get();
        $sql = 'SELECT SQL_CALC_FOUND_ROWS *, UNIX_TIMESTAMP(publication_date) AS publication_date,
            UNIX_TIMESTAMP(modification_date) AS modification_date,
            UNIX_TIMESTAMP(expire_date) AS expire_date
            FROM products LIMIT :numRows';

        $st = $conn->prepare($sql);
        $st->bindValue(':numRows', $numRows, PDO::PARAM_INT);
        $st->execute();
        $list = array();
        while ($row = $st->fetch()) {
            $product = new Product($row);
            $list[] = $product;
        }
        $sql = 'SELECT FOUND_ROWS() AS total_rows';
        $total_rows = $conn->query($sql)->fetch();
        DBConn::close();
        return (array('result' => $list, 'total_rows' => $total_rows[0]));
    }

    /**
     * Return list of products belongs to the specified category
     * 
     * @param int category id
     * 
     * @return array Array of products belongs to the specified category
     */
    public static function get_by_category(int $category_id): array {
        $data = Product::get_list();
        $products = $data['result'];
        $result = array();
        $result_amt = 0;
        foreach($products as $product) {
            if ($product->category_id == $category_id) {
                $result[] = $product;
                $result_amt++;
            }
        }
        return (array('result' => $result, 'result_amt' => $result_amt));
    }

    /**
     * Returns full price for the product
     * 
     * @return float Full price for the product
     */
    public function get_price_with_taxes(): float {
        return $this->netto_price + ($this->netto_price * $this->tax/100.0);
    }
}
?>