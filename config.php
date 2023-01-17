<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', '1');
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

// define('DB_DSN', 'mysql:host=mysql0.small.pl;dbname=m1598_samojluk1');
// define('DB_USERNAME', 'm1598_samojluk1');
// define('DB_PASSWORD', 'Samojluk1');
define('DB_DSN', 'mysql:host=localhost;dbname=awesome_game');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DEFAULT_NUM_NEWS', 5);
define('DEFAULT_ERROR', 'Oops! Something went wrong. Please try again later.');

/**
 * Returns a coprights info
 * 
 * @return string Copright content
 */
function copyright_message(): string {
    return "&copy; 2022" . ((date('Y') != "2022") ? ("-" . date('Y')) : ("")) . " " . $_SERVER['HTTP_HOST'];
}

/**
 * Parse a array into string
 * 
 * @param array Array to parse
 * 
 * @return string Parse message
 */
function parse_array(array $returned): string {
    $message = "";
    foreach ($returned as $error) {
        $message .= $error . '\\n';
    }
    return $message;
}


/**
 * Prints an alert
 * 
 * @param string A message to print
 * @param bool Indicates if message is about a failure
 * @return void
 */
function message(string $message, bool $is_error = true): void {
    if ($is_error) {
        $message = "Failure: " . $message;
    } else {
        $message = "Success: " . $message;
    }
    echo '<script>';
    echo '$(document).ready(function() {';
    echo "alert(\"$message\");";
    echo '});';
    echo '</script>';
}
?>
