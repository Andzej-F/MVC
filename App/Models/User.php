<?php

namespace App\Models;

use PDO;

/**
 * Example user model
 * 
 * PHP version 8.0.7
 */
class User extends \Core\Model
{
    /**
     * Error messages
     * 
     * @var array
     */
    public $errors = [];

    /**
     * Class constructor
     * 
     * @param array $data Initial property values
     * 
     * @return void
     */
    //     $user->name => "Dave";
    //     $user->email => "dave@example.com";
    //     $user->password => "secret";
    //     $user->password_confirmation => "secret";

    // $data = [
    //     "name" => "Dave",
    //     "email" => "dave@example.com",
    //     "password" => "secret",
    //     "password_confirmation" => "secret"
    // ];
    public function __construct($data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
            // $this->name = 'Dave';
            // $this->email = 'dave@example.com';
            // $this->password = 'secret';
            // $this->password_confirmation = 'secret';
        }
    }

    /**
     * Save the user model with the current property values
     * 
     * @return void
     */
    public function save()
    {
        $this->validate();

        if (empty($this->errors)) {

            $password_hash = password_hash($this->password, PASSWORD_DEFAULT);

            $sql = 'INSERT INTO `users`(`name`, `email`, `password_hash`)
              VALUES (:name, :email, :password_hash)';

            $db = static::getDB();

            $stmt = $db->prepare($sql);

            $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
            $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);

            return $stmt->execute();
        }

        return false;
    }

    /**
     * Validate current property values, adding validation error messages
     * to the errors array property
     * 
     * @return void
     */
    public function validate()
    {
        // Name
        if ($this->name == '') {
            $this->errors[] = 'Name is required';
        }

        // Email
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
            $this->errors[] = 'Invalid email';
        }
        if ($this->emailExists($this->email)) {
            $this->errors[] = 'email already taken';
        }

        // Password
        if ($this->password != $this->password_confirmation) {
            $this->errors[] = 'Password must match confirmation';
        }

        if (strlen($this->password) < 6) {
            $this->errors[] = 'Please enter at least 6 characters for the password';
        }

        if (preg_match('/[a-z]+/i', $this->password) == 0) {
            $this->errors[] = 'Password needs at least one letter';
        }

        if (preg_match('/\d+/i', $this->password) == 0) {
            $this->errors[] = 'Password needs at least one number';
        }
    }

    /**
     * See if a user record already exists with the specified email
     * 
     * @param string $email address to search for
     * 
     * @return boolean True if a record already exists with the specified email,
     * false otherwise
     */
    public function emailExists($email)
    {
        $sql = 'SELECT * FROM `users` WHERE email = :email';

        $db = static::getDB();

        $stmt = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        $stmt->execute();

        $result = $stmt->fetch();

        return $stmt->fetch() !== false;
    }
}

// echo '<pre>';
// echo "printing in <br>" . __FILE__, __LINE__ . '<br>';
// print_r($db);
// var_dump($db);
// echo '</pre>';