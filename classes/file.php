<?php

/**
 * Class to handle files
 */
class File {
    // Properties
    /**
     * @var int The news id from the database
     */
    public $id = null;
    /**
     * @var string The file mime from the database
     */
    public $mime = null;
    /**
     * @var blob The blob data from the database
     */
    public $data = null;

    public function __construct(array $data) {
        if (isset($data['id'] )) $this->id = (int) $data['id'];
        if (isset($data['mime'])) $this->mime = $data['mime'];
        if (isset($data['data'])) $this->data = $data['data'];
    }

    /**
     * Returns an File object matching the given file id
     *
     * @param int The file id
     * @return File|false The File object, or false if the record was not found or there was a problem
    */
    public static function get_by_id(int $id): File|false {
        $conn = DBConn::get();
        $sql = 'SELECT *FROM newsletter WHERE id = :id LIMIT 1';
        $st = $conn->prepare($sql);
        $st->bindValue(':id', $id, PDO::PARAM_INT);
        $st->execute();
        $row = $st->fetch();
        DBConn::close();
        if ($row) {
            return new File($row);
        }
        return false;
    }

    /**
     * Return array of files
     * 
     * @param int Optional number of files to get
     * 
     * @return array Array of files and the number of files
     */
    public static function get_list(?int $numRows=1000000): array {
        $conn = DBConn::get();
        $sql = 'SELECT SQL_CALC_FOUND_ROWS * FROM files LIMIT :numRows';

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
}