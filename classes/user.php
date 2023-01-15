<?php
/**
 * Class to handle Users
 */
class User {
    public $id = null;
    public $username = null;
    public $email = null;
    public $is_admin = null;
    private $money = null;

    public function __construct(array $data) {
        if (isset($data['id'] )) $this->id = (int) $data['id'];
        if (isset($data['username'])) $this->username = $data['username'];
        if (isset($data['email'])) $this->email = $data['email'];
        if (isset($data['is_admin'])) $this->is_admin = (bool) $data['is_admin'];
        if (isset($data['money'])) $this->money = (int) $data['money'];
    }

    static public function login(string $username, string $password): User|array {
        $errors = array();

        $username = trim($username);
        $password = trim($password);

        if (empty($username)) {
            $errors[] = 'Please enter username.';
        }

        if (empty($password)) {
            $errors[] = 'Please enter your password.';
        }

        if (!empty($errors)) {
            return $errors;
        }

        $conn = DBConn::get();
        $sql = 'SELECT id, username, password, email, is_admin, money FROM users WHERE username = :username LIMIT 1';
        $st = $conn->prepare($sql);
        $st->bindValue(':username', $username, PDO::PARAM_STR);
        if($st->execute()) {
            if($st->rowCount() == 1) {
                $row = $st->fetch();
                if (password_verify($password, $row['password'])) {
                    return new User($row);
                } else {
                    $errors[] = 'Invalid username or password.';
                }
            } else {
                $errors[] = 'Invalid username or password.';
            }
        } else {
            $errors[] = 'Oops! Something went wrong. Please try again later.';
        }
        DBConn::close();
        return $errors;
    }

    static public function register(string $email) {
        $errors = array();

        $email = trim($email);
        if (empty(trim($email))) {
            $errors[] = 'Please enter a email.';
            return $errors;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Incorrect email format.';
            return $errors;
        }

        $conn = DBConn::get();
        $sql = "SELECT id FROM users WHERE username = :email LIMIT 1";
        $st = $conn->prepare($sql);
        $st->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
        if (!$st->execute()) {
            $errors[] = "Oops! Something went wrong. Please try again later.";
            return $errors;
        }

        if ($st->rowCount() == 1) {
            $errors[] = "This email is already taken.";
            return $errors;
        }

        DBConn::close();
        return $errors;
    }

    function get_money(): int {
        return $this->money;
    }
}
?>