<?php
/**
 * Class to handle categories
 */
class Category {
    // Properties
    /**
     * @var int Category id
     */
    public $id = null;
    /**
     * @var int Category's parent id
     */
    public $parent = null;
    /**
     * @var string Category name
     */
    public $name = null;

    public function __construct($data=array()) {
        if (isset($data['id'] )) $this->id = (int) $data['id'];
        if (isset($data['parent'])) $this->parent = (int) $data['parent'];
        if (isset($data['name'])) $this->name = preg_replace("/[^A-Za-z0-9.!?]/", "", $data['name']);
    }

    /**
     * Return list of categories
     * 
     * @param int Optional number of categories to get
     * 
     * @return array Array of categories and the number of categories
     */
    public static function get_list(?int $numRows=1000000): array {
        $conn = DBConn::get();
        $sql = 'SELECT SQL_CALC_FOUND_ROWS * FROM categories LIMIT :numRows';

        $st = $conn->prepare($sql);
        $st->bindValue(':numRows', $numRows, PDO::PARAM_INT);
        $st->execute();
        $list = array();
        while ($row = $st->fetch()) {
            $category = new Category($row);
            $list[] = $category;
        }
        $sql = 'SELECT FOUND_ROWS() AS total_rows';
        $total_rows = $conn->query($sql)->fetch();
        DBConn::close();
        return (array('result' => $list, 'total_rows' => $total_rows[0]));
    }

    /**
     * Returns an Category object matching the given category ID
     *
     * @param int The category ID
     * @return Category|false The Category object, or false if the record was not found or there was a problem
    */
    public static function get_by_id($id) {
        $conn = DBConn::get();
        $sql = 'SELECT * FROM categories WHERE id = :id LIMIT 1';
        $st = $conn->prepare($sql);
        $st->bindValue(':id', $id, PDO::PARAM_INT);
        $st->execute();
        $row = $st->fetch();
        DBConn::close();
        if ($row) {
            return new Category($row);
        }
        return false;
    }

    /**
     * Deletes the current Category object from the database.
     * 
     * @param void
     * 
     * @return bool indicates if the object was removed
    */
    public function delete(): bool{
        if (is_null($this->id)) trigger_error ("Category::delete(): Attempt to delete an Category
            object that does not have its ID property set.", E_USER_ERROR);
        $conn = DBConn::get();
        $st = $conn->prepare ("DELETE FROM categories WHERE id = :id LIMIT 1");
        $st->bindValue(":id", $this->id, PDO::PARAM_INT);
        if ($st->execute()) {
            return true;
        }
        DBConn::close();
        return false;
      }

    /**
     * Sets the object's properties using the edit form post values in the supplied array
     *
     * @param assoc The form post values
    */
    public function store_form_values($params) {
        $this->__construct($params);
    }

    /**
     * Inserts the current Newsletter object into the database, and sets its ID property.
     * 
     * @return int indicates the success or failure inserting the row into the database
    */
    public function insert(): bool {
        if (!is_null($this->id))
            trigger_error('Category::insert(): Attempt to insert an Category object that already
                has its ID property set (to $this->id).', E_USER_ERROR );

        $conn = DBConn::get();
        $sql = 'INSERT INTO categories (parent, name) VALUES (:parent, :name)';
        $st = $conn->prepare ( $sql );
        $st->bindValue(':parent', $this->parent, PDO::PARAM_INT);
        $st->bindValue(':name', $this->name, PDO::PARAM_STR);
        if (!$st->execute()) {
            return false;
        }
        $this->id = $conn->lastInsertId();
        DBConn::close();
        return true;
    }

  /**
  * Updates the current Category object in the database.
  * 
  * @return bool indicates a success or a failure in updating of the object
  */
  public function update(): bool {
    if (is_null($this->id)) trigger_error('Category::update(): Attempt to update an Category object
        that does not have its ID property set.', E_USER_ERROR );

    $conn = DBConn::get();
    $sql = 'UPDATE categories SET parent=:parent, name=:name WHERE id = :id';
    $st = $conn->prepare($sql);
    $st->bindValue(':parent', $this->parent, PDO::PARAM_STR);
    $st->bindValue(':name', $this->name, PDO::PARAM_STR);
    $st->bindValue(':id', $this->id, PDO::PARAM_INT);
    if (!$st->execute()) {
        return false;
    }
    DBConn::close();
    return true;
  }

}
?>