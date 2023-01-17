<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Class to handle emails
 */
class Mailer extends PHPMailer {
    /**
     * Sets the object's properties using the values in the supplied array
     *
     * @param assoc The property values
     */
    public function __construct(array $data) {
        parent::__construct(true);
        $this->SMTPDebug = 2;
        $this->isSMTP();
        $this->Host = 'smtp.gmail.com';
        $this->SMTPAuth = true;
        $this->Username = 'damian28102000@gmail.com';
        $this->Password = 'gapkyopweupjcqnw';
        $this->SMTPSecure = 'tls';
        $this->Port = 587;

        $this->setFrom(filter_var($data['email'], FILTER_VALIDATE_EMAIL));
        $this->addAddress(filter_var($data['email'], FILTER_VALIDATE_EMAIL));

        $this->isHTML(true);
        $this->Subject = htmlspecialchars($data['subject']);
        $this->Body = $data['body'];
        $this->AltBody = htmlspecialchars($data['body']);
    }

    /**
     * Sends the email
     * 
     * @return bool Indicates success or failure of the action
     */
    public function send(): bool {
        try {
            parent::send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
?>