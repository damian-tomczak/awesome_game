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

    // TODO: validate data
    public function __construct(array $data) {
        if (isset($data['id'] )) $this->id = (int) $data['id'];
        if (isset($data['username'])) $this->username = $data['username'];
        if (isset($data['email'])) $this->email = $data['email'];
        if (isset($data['is_admin'])) $this->is_admin = (bool) $data['is_admin'];
        if (isset($data['money'])) $this->money = (int) $data['money'];
    }

    static public function create(string $username, string $password): User|array {
        $errors = array();

        $username = trim($username);
        $password = trim($password);

        if (empty($username)) {
            $errors[] = "Please enter username.";
        }

        if (empty($password)) {
            $errors[] = "Please enter your password.";
        }

        if (!empty($errors)) {
            return $errors;
        }

        $conn = DBConn::get();
        $sql = "SELECT id, username, password, email, is_admin, money FROM users WHERE username = :username LIMIT 1";
        $st = $conn->prepare($sql);
        $st->bindValue(":username", $username, PDO::PARAM_STR);
        if($st->execute()) {
            if($st->rowCount() == 1) {
                $row = $st->fetch();
                if (password_verify($password, $row["password"])) {
                    return new User($row);
                } else {
                    $errors[] = "Invalid username or password.";
                }
            } else {
                $errors[] = "Invalid username or password.";
            }
        }
        DBConn::close();
        return $errors;
    }

    function getMoney(): int {
        return $this->money;
    }
}
?>