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
     * @param int Optional number of category to get
     * 
     * @return array array of categories and the number of categories
     */
    public static function get_list($numRows=1000000): array {
        $conn = DBConn::get();
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM categories LIMIT :numRows";

        $st = $conn->prepare($sql);
        $st->bindValue(":numRows", $numRows, PDO::PARAM_INT);
        $st->execute();
        $list = array();
        while ($row = $st->fetch()) {
            $category = new Category($row);
            $list[] = $category;
        }
        $sql = "SELECT FOUND_ROWS() AS total_rows";
        $total_rows = $conn->query($sql)->fetch();
        DBConn::close();
        return (array("result" => $list, "total_rows" => $total_rows[0]));
    }
}
?>