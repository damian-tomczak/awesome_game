<?php
/**
 * Class to handle
 */
class Newsletter
{
    // Properties
    /**
     * @var int The news ID from the database
     */
    public $id = null;
    /**
     * @var int When the news is to be / was first published
     */
    public $publication_date = null;
    /**
     * @var string Full title of the news
     */
    public $title = null;
    /**
     * @var string A short summary of the news
     */
    public $summary = null;
    /**
     * @var string The HTML content of the news
     */
    public $content = null;
    /**
     * @var string A url to the highlighted image of the news
     */
    public $image_url = null;
    /**
     * @var bool Bollean indicates whether the news should be displayed
     */
    public $activated = null;


    /**
     * Sets the object's properties using the values in the supplied array
     *
     * @param assoc The property values
     */
    public function __construct($data=array()) {
        if (isset($data['id'] )) $this->id = (int) $data['id'];
        if (isset($data['publication_date'])) $this->publication_date = (int) $data['publication_date'];
        if (isset($data['title'])) $this->title = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['title']);
        if (isset($data['summary'])) $this->summary = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['summary']);
        if (isset($data['content'])) $this->content = $data['content'];
        if (isset($data['image_url'])) $this->image_url = $data['image_url'];
        if (isset($data['activated'])) $this->activated = $data['activated'];
    }


    /**
     * Sets the object's properties using the edit form post values in the supplied array
     *
     * @param assoc The form post values
    */
    public function storeFormValues($params) {
        $this->__construct($params);
        if (isset($params['publication_date'])) {
          $publication_date = explode ('-', $params['publication_date']);
          if (count($publication_date) == 3) {
            list ($y, $m, $d) = $publication_date;
            $this->publication_date = mktime(0, 0, 0, $m, $d, $y);
          }
        }
    }

    /**
     * Returns an News object matching the given news ID
     *
     * @param int The news ID
     * @return Newsletter|false The Newsletter object, or false if the record was not found or there was a problem
    */
    public static function getById($id) {
        $conn = null;
        try {
            $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
        $sql = "SELECT *, UNIX_TIMESTAMP(publication_date) AS publication_date FROM newsletter WHERE id = :id LIMIT 1";
        $st = $conn->prepare($sql);
        $st->bindValue(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ($row) return new Newsletter($row);
    }

    /**
     * Returns all (or a range of) News objects in the DB
     *
     * @param int Optional The number of rows to return (default=all)
     * @return Newsletter|false A two-element array : results => array, a list of News objects; totalRows => Total number of news
    */
    public static function getList($numRows=1000000) {
        $conn = null;
        try {
            $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
        $sql = "SELECT SQL_CALC_FOUND_ROWS *, UNIX_TIMESTAMP(publication_date) AS publication_date FROM newsletter
            ORDER BY publication_date DESC LIMIT :numRows";

        $st = $conn->prepare($sql);
        $st->bindValue(":numRows", $numRows, PDO::PARAM_INT);
        $st->execute();
        $list = array();
        while ($row = $st->fetch()) {
            $article = new Newsletter($row);
            $list[] = $article;
        }
        $sql = "SELECT FOUND_ROWS() AS total_rows";
        $total_rows = $conn->query($sql)->fetch();
        $conn = null;
        return (array("results" => $list, "total_rows" => $total_rows[0]));
    }

    /**
     * Inserts the current Newsletter object into the database, and sets its ID property.
    */
    public function insert() {
        if (!is_null($this->id))
            trigger_error("Newsletter::insert(): Attempt to insert an Newsletter object that already has its ID property set (to $this->id).", E_USER_ERROR );
        $conn = null;
        try {
            $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
        $sql = "INSERT INTO newsletter (publication_date, title, summary, content, image_url, activated)
            VALUES ( FROM_UNIXTIME(:publication_date), :title, :summary, :content, :image_url, :activated)";
        $st = $conn->prepare ( $sql );
        $st->bindValue(":publication_date", $this->publication_date, PDO::PARAM_INT);
        $st->bindValue(":title", $this->title, PDO::PARAM_STR);
        $st->bindValue(":summary", $this->summary, PDO::PARAM_STR);
        $st->bindValue(":content", $this->content, PDO::PARAM_STR);
        $st->bindValue(":image_url", $this->image_url, PDO::PARAM_STR);
        $st->bindValue(":activated", $this->activated, PDO::PARAM_BOOL);
        $st->execute();
        $this->id = $conn->lastInsertId();
        $conn = null;
    }

    /**
     * Deletes the current Newsletter object from the database.
    */
    public function delete() {
        if (is_null($this->id)) trigger_error ("Newsletter::delete(): Attempt to delete an Newsletter object that does not have its ID property set.", E_USER_ERROR);
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $st = $conn->prepare ("DELETE FROM newsletter WHERE id = :id LIMIT 1");
        $st->bindValue(":id", $this->id, PDO::PARAM_INT);
        $st->execute();
        $conn = null;
      }

    /**
     * Updates the current Article object in the database.
    */
    public function update() {
        if (is_null($this->id)) trigger_error("Newsletter:update(): Attempt to update an Newsletter object that does not have its ID property set.", E_USER_ERROR);
        $conn = null;
        try {
            $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
        $sql = "UPDATE newsletter SET title=:title WHERE id = :id";
        $st = $conn->prepare ($sql);
        $st->bindValue(":title", $this->title, PDO::PARAM_STR);
        $st->bindValue(":id", $this->id, PDO::PARAM_INT);
        $st->execute();
        $conn = null;
      }
}
?>
