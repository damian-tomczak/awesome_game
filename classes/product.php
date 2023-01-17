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
    public $availability_amt = null;
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
    public function __construct(array $data=array()) {
        if (isset($data['id'] )) $this->id = (int) $data['id'];
        if (isset($data['title'])) $this->title = $data['title'];
        if (isset($data['description'])) $this->description = $data['description'];
        if (isset($data['publication_date'])) $this->publication_date = $data['publication_date'];
        if (isset($data['modification_date'])) $this->modification_date = $data['modification_date'];
        if (isset($data['expire_date'])) $this->expire_date = $data['expire_date'];
        if (isset($data['netto_price'])) $this->netto_price = (float) $data['netto_price'];
        if (isset($data['tax'])) $this->tax = (float) $data['tax'];
        if (isset($data['availability_amt'])) $this->availability_amt = $data['availability_amt'];
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

    /**
     * Returns an product object matching the given product ID
     *
     * @param int The product ID
     * @return Product|bool The product object, or false if the record was not found or there was a problem
    */
    public static function get_by_id($id): Product|bool {
        $conn = DBConn::get();
        $sql = 'SELECT * FROM products WHERE id = :id LIMIT 1';
        $st = $conn->prepare($sql);
        $st->bindValue(':id', $id, PDO::PARAM_INT);
        $st->execute();
        $row = $st->fetch();
        DBConn::close();
        if ($row) {
            return new Product($row);
        }
        return false;
    }

    /**
     * Sets the object's properties using the edit form post values in the supplied array
     *
     * @param assoc The form post values
    */
    public function store_form_values(mixed $params) {
        $this->__construct($params);
        $this->publication_date = strtotime('now');
        $this->modification_date = strtotime('now');
    }

    /**
     * Inserts the current product object into the database, and sets its ID property.
     * 
     * @return int indicates the success or failure inserting the row into the database
    */
    public function insert(): bool {
        if (!is_null($this->id))
            trigger_error('Product::insert(): Attempt to insert an product object that already
                has its ID property set (to $this->id).', E_USER_ERROR);
        $conn = DBConn::get();
        $sql = 'INSERT INTO products (title, description, publication_date, modification_date, expire_date,
            netto_price, tax, availability_amt, availability_status, category_id, size, file_id)
            VALUES (:title, :description, FROM_UNIXTIME(:publication_date), FROM_UNIXTIME(:modification_date), FROM_UNIXTIME(:expire_date),
            :netto_price, :tax, :availability_amt, :availability_status, :category_id, :size, :file_id)';
        $st = $conn->prepare ($sql);
        $st->bindValue(':title', $this->title, PDO::PARAM_STR);
        $st->bindValue(':description', $this->description, PDO::PARAM_STR);
        $st->bindValue(':publication_date', $this->publication_date, PDO::PARAM_INT);
        $st->bindValue(':modification_date', $this->modification_date, PDO::PARAM_INT);
        $st->bindValue(':expire_date', $this->expire_date, PDO::PARAM_INT);
        $st->bindValue(':netto_price', $this->netto_price, PDO::PARAM_STR);
        $st->bindValue(':tax', $this->tax, PDO::PARAM_STR);
        $st->bindValue(':availability_amt', $this->availability_amt, PDO::PARAM_INT);
        $st->bindValue(':availability_status', $this->availability_status, PDO::PARAM_BOOL);
        $st->bindValue(':category_id', $this->category_id, PDO::PARAM_INT);
        $st->bindValue(':size', $this->size, PDO::PARAM_INT);
        $st->bindValue(':file_id', $this->file_id, PDO::PARAM_INT);
        if (!$st->execute()) {
            return false;
        }
        $this->id = $conn->lastInsertId();
        DBConn::close();
        return true;
    }

    /**
     * Checks conditions if the product should be displayed for the user
     * 
     * @return bool The answer to the question if the product should be displayed
     */
    public function should_be_displayed(): bool {
        if ($this->availability_status) {
            if (!$this->expire_date) {
                return true;
            } elseif ($this->expire_date > strtotime('now')) {
                return true;
            }

        }
        return false;
    }

    /**
     * Updates the current object in the database.
     * 
     * @return bool Indicates success or failure of the method
    */
    public function update(): bool {
        if (is_null($this->id)) trigger_error("Product::update(): Attempt to update an object that
            does not have its ID property set.", E_USER_ERROR);

        $conn = DBConn::get();
        $sql = "UPDATE products SET title=:title, description=:description,
            publication_date=FROM_UNIXTIME(:publication_date),
            modification_date=FROM_UNIXTIME(:modification_date),
            expire_date=FROM_UNIXTIME(:expire_date), netto_price=:netto_price, tax=:tax,
            availability_amt=:availability_amt, availability_status=:availability_status,
            category_id=:category_id,
            size=:size, file_id=:file_id WHERE id = :id";
        $st = $conn->prepare($sql);
        $st->bindValue(':title', $this->title, PDO::PARAM_STR);
        $st->bindValue(':description', $this->description, PDO::PARAM_STR);
        $st->bindValue(':publication_date', $this->publication_date, PDO::PARAM_INT);
        $st->bindValue(':modification_date', $this->modification_date, PDO::PARAM_INT);
        $st->bindValue(':expire_date', $this->expire_date, PDO::PARAM_INT);
        $st->bindValue(':netto_price', $this->netto_price, PDO::PARAM_STR);
        $st->bindValue(':tax', $this->tax, PDO::PARAM_STR);
        $st->bindValue(':availability_amt', $this->availability_amt, PDO::PARAM_INT);
        $st->bindValue(':availability_status', $this->availability_status, PDO::PARAM_BOOL);
        $st->bindValue(':category_id', $this->category_id, PDO::PARAM_INT);
        $st->bindValue(':size', $this->size, PDO::PARAM_INT);
        $st->bindValue(':file_id', $this->file_id, PDO::PARAM_INT);
        $st->bindValue(':id', $this->id, PDO::PARAM_INT);
        if (!$st->execute()) {
            return false;
        }
        DBConn::close();
        return true;
    }

    /**
     * Deletes the current object from the database.
     * 
     * @return bool Indicates success or failure of the method
    */
    public function delete(): bool {
        if (is_null($this->id) ) trigger_error("Product::delete(): Attempt to delete a product object
            that does not have its ID property set.", E_USER_ERROR);

        $conn = DBConn::get();
        $st = $conn->prepare("DELETE FROM products WHERE id = :id LIMIT 1");
        $st->bindValue(":id", $this->id, PDO::PARAM_INT);
        if (!$st->execute()) {
            return false;
        }
        DBConn::close();
        return true;
    }
}
?>