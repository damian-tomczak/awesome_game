<?php
/**
 * Class to handle Users
 */
class User {
    // Properties
    /**
     * @var int User ID
     */
    public $id = null;
    /**
     * @var string User username
     */
    public $username = null;
    /**
     * @var string User email
     */
    public $email = null;
    /**
     * @var bool Indicates if the user is the admin
     */
    public $is_admin = null;
    /**
     * @var float User money to spend
     */
    private $money = null;

    /**
     * Sets the object's properties using the values in the supplied array
     *
     * @param assoc The property values
     */
    public function __construct(array $data) {
        if (isset($data['id'] )) $this->id = (int) $data['id'];
        if (isset($data['username'])) $this->username = $data['username'];
        if (isset($data['email'])) $this->email = $data['email'];
        if (isset($data['is_admin'])) $this->is_admin = (bool) $data['is_admin'];
        if (isset($data['money'])) $this->money = (int) $data['money'];
    }

    /**
     * Handling login
     * 
     * @param string User username
     * @param string User password
     * 
     * @return object|array Returns User object or array of errors
     */
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
            $errors[] = DEFAULT_ERROR;
        }
        DBConn::close();
        return $errors;
    }

    /**
     * Handling registration
     * 
     * @param string User email
     * @param string User username
     * @param string User password
     * @param string User repeated password
     * 
     * @return array empty or no array of errors
     */
    static public function register(string $email,
        string $username,
        string $password,
        string $confirm_password): array
    {
        $errors = array();

        $email = trim($email);
        if (empty(trim($email))) {
            $errors[] = 'Please enter a email.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Incorrect email format.';
        }
        if (!empty($errors)) {
            return $errors;
        }

        $conn = DBConn::get();
        $sql = 'SELECT id FROM users WHERE email = :email LIMIT 1';
        $st = $conn->prepare($sql);
        $st->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
        if (!$st->execute()) {
            $errors[] = DEFAULT_ERROR;
        }
        if (!empty($errors)) {
            return $errors;
        }

        if ($st->rowCount() == 1) {
            $errors[] = 'This email is already taken.';
        }
        if (!empty($errors)) {
            return $errors;
        }

        $username = trim($username);

        if (empty($username)) {
            $errors[] = 'Please enter a username.';
        } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST['username']))) {
            $errors[] = 'Username can only contain letters, numbers, and underscores.';
        } else {
            $sql = 'SELECT id FROM users WHERE username = :username LIMIT 1';
            $st = $conn->prepare($sql);
            $st->bindValue(':username', $username, PDO::PARAM_STR);
            if (!$st->execute()) {
                $errors[] = DEFAULT_ERROR;
            }

            if ($st->rowCount() == 1) {
                $errors[] = 'This username is already taken.';
            }
        }
        if (!empty($errors)) {
            return $errors;
        }

        if (empty($password)) {
            $errors[] = 'Please enter a password.';
        } elseif (strlen($password) < 6) {
            $errors[] = 'Password must have atleast 6 characters.';
        }

        if (empty($confirm_password)) {
            $errors[] = 'Please confirm password.';
        } else {
            if(empty($errors) && ($password != $confirm_password)) {
                $errors[] = 'Password did not match.';
            }
        }
        if (!empty($errors)) {
            return $errors;
        }

        $sql = 'INSERT INTO users (username, password, email) VALUES (:username, :password, :email)';
        $st = $conn->prepare($sql);
        $st->bindValue(':username', $username, PDO::PARAM_STR);
        $st->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
        $st->bindValue(':email', $email, PDO::PARAM_STR);
        if(!$st->execute()) {
            $errors[] = DEFAULT_ERROR;
        }

        DBConn::close();
        return $errors;
    }

    /**
     * Get User's money
     * 
     * @return float User's money
     */
    public function get_money(): float {
        return $this->money;
    }

    /**
     * Decrease user's money
     * 
     * @param float Amount to decrease
     */
    public function decrease_money(float $amt): void {
        $this->money -= $amt;
        $this->update();
    }

    /**
     * Reset the password
     *
     * @param string Email
     * @return string|null New password if object with the specified email exists
    */
    public static function reset_password(string $email): string|null {
        $conn = DBConn::get();
        $pwd = bin2hex(openssl_random_pseudo_bytes(4));
        $sql = 'UPDATE users SET password=:password WHERE email = :email';
        $st = $conn->prepare($sql);
        $st->bindValue('password', password_hash($pwd, PASSWORD_DEFAULT), PDO::PARAM_STR);
        $st->bindValue('email', $email, PDO::PARAM_STR);
        if ($st->execute() && $st->rowCount()) {
            return $pwd;
        }
        DBConn::close();
        return null;
    }

    /**
     * Updates the current object in the database.
     * 
     * @return bool indicates a success or a failure in updating of the object
    */
    public function update(): bool {
        if (is_null($this->id)) trigger_error('User::update(): Attempt to update an object
            that does not have its ID property set.', E_USER_ERROR);

        $conn = DBConn::get();
        $sql = 'UPDATE users SET money=:money WHERE id = :id';
        $st = $conn->prepare($sql);
        $st->bindValue(':money', $this->money, PDO::PARAM_INT);
        $st->bindValue(':id', $this->id, PDO::PARAM_INT);
        if (!$st->execute()) {
            return false;
        }
        DBConn::close();
        return true;
    }
}
?>