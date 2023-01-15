<?php
/**
 * Class to handle Connections
 */
final class DBConn {
    // Properties
    /**
     * @var static PDO Object with connection to database
     */
    private static $conn = null;

    /**
     * If connections with database exists returns it, otherwise creates it and returns
     * 
     * @return object PDO Object
     */
    public static function get(): object {
        try {
            if (self::$conn == null) {
                self::$conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            }
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
        return self::$conn;
    }

    /**
     * Close connection with database
     * 
     * @return void
     */
    public static function close(): void {
        self::$conn = null;
    }
}
?>