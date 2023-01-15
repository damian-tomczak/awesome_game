<?php

class Category {
    public $id = null;
    public $parent = null;
    public $name = null;

    public function __construct($data=array()) {
        if (isset($data['id'] )) $this->id = (int) $data['id'];
        if (isset($data['parent'])) $this->parent = (int) $data['parent'];
        if (isset($data['name'])) $this->name = preg_replace("/[^A-Za-z0-9.!?]/", "", $data['name']);
    }

    public static function getList($numRows=1000000) {
        $conn = null;
        try {
            $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
        $sql = "SELECT * FROM categories LIMIT :numRows";

        $st = $conn->prepare($sql);
        $st->bindValue(":numRows", $numRows, PDO::PARAM_INT);
        $st->execute();
        $list = array();
        while ($row = $st->fetch()) {
            echo '123';
            print_r($row);
            $category = new Category($row);
            $list[] = $category;
        }
        $conn = null;
        return $list;
    }
}

class Shop {
};

?>