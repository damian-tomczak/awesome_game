<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', '1');
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

define("DB_DSN", "mysql:host=localhost;dbname=awesome_game");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DEFAULT_NUM_NEWS", 5);

/**
 * Returns coprights info
 * 
 * @return string Copright content
 */
function copyright_message(): string {
    return "&copy; 2022" . ((date('Y') != "2022") ? ("-" . date('Y')) : ("")) . " " . $_SERVER['HTTP_HOST'];
}

/**
 * Checks if creation of the object finished with success
 * 
 * @return bool Result
 */
function is_valid(object|array $returned): bool {
    if (gettype($returned) == 'array') {
        $message = "";
        foreach ($returned as $error) {
            $message .= $error . '\\n';
        }
        message($message);
        return false;
    }
    return true;
}


/**
 * Prints a alert
 * 
 * @param string A message to print
 * @param bool Indicates if message is about a failure
 * @return void
 */
function message(string $message, bool $is_error = true): void {
    if ($is_error) {
        $message = "Failure: " . $message;
    }
    echo '<script>';
    echo '$(document).ready(function() {';
    echo "alert(\"$message\");";
    echo '});';
    echo '</script>';
}
?>
