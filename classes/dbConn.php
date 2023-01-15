<?php
/**
 * Class to handle Connections
 */
final class DBConn {
    private static $conn = null;

    public static function get() {
        try {
            self::$conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
        return self::$conn;
    }

    public static function close() {
        self::$conn = null;
    }
}
?>