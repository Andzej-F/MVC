<?php

namespace App\Models;

use PDO;

/**
 * Example user model
 * 
 * PHP version 8.1.1
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

    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Save the user model with the current property values
     * 
     * @return boolean
     */
    public function save()
    {
        $this->validate();

        if (empty($this->errors)) {

            $password_hash = password_hash($this->password, PASSWORD_DEFAULT);

            $sql = 'INSERT INTO `users`(`name`, `surname`, `email`, `password_hash`)
                    VALUES (:name, :surname, :email, :password_hash)';

            $db = static::getDB();

            $stmt = $db->prepare($sql);

            $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
            $stmt->bindValue(':surname', $this->surname, PDO::PARAM_STR);
            $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);

            // Returns true on success or false on failure.
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
        // echo '<pre>';
        // var_dump($this);
        // var_dump($_POST);
        // echo '</pre>';
        // exit;

        // Name
        if ($this->name == '') {
            $this->errors[] = 'Name is required';
        }

        // Surname
        if ($this->surname == '') {
            $this->errors[] = 'Surname is required';
        }

        // Email
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
            $this->errors[] = 'Invalid email';
        }

        if (isset($this->id)) {
            if (static::isEmailTaken($this->email, $this->id)) {
                $this->errors[] = 'User with the same email is already registered';
            }
        } elseif (static::emailExists($this->email)) {
            $this->errors[] = 'email already taken';
        }

        // Validate the password if the property is set
        if (isset($this->password)) {
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
    }

    /**
     * See if a user record already exists with the specified email
     * 
     * @param string $email address to search for
     * 
     * @return boolean True if a record already exists with the specified email,
     * false otherwise
     */
    public static function emailExists($email)
    {
        return static::findByEmail($email) !== false;
    }

    /**
     * Find a user model by email address
     * 
     * @param string $email email address to search for
     * 
     * @return mixed User object if found, false otherwise
     */
    public static function findByEmail($email)
    {
        $sql = 'SELECT * FROM `users` WHERE email = :email';

        $db = static::getDB();

        $stmt = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * Check if there is another user with the same email address
     * 
     * @param string $email email address to search for
     * @param int $id Current user's id
     * 
     * @return mixed User object if found, false otherwise
     */
    public static function isEmailTaken($email, $id)
    {
        $sql = 'SELECT * FROM `users` WHERE email = :email
                AND id != :id';

        $db = static::getDB();

        $stmt = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * Authenticate a user by email and password
     * 
     * @param string $email email address
     * @param string $password password
     * 
     * @return mixed The user object or false if authentication fails
     */
    public static function authenticate($email, $password)
    {
        $user = static::findByEmail($email);

        if ($user) {
            if (password_verify($password, $user->password_hash)) {
                return $user;
            }
        }

        return false;
    }

    /**
     * Find a user model by ID
     * 
     * @param string $id The user ID
     * 
     * @return mixed User object if found, false otherwise
     */
    public static function findByID($id)
    {
        $sql = 'SELECT * FROM `users` WHERE id = :id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * Update the user's profile
     * 
     * @param array $data Data from the edit profile form
     * 
     * @return boolean True if the data was updated, false otherwise
     */
    public function updateProfile($data)
    {
        // echo '<pre>';
        // print_r($data);
        // print_r($_POST);
        // print_r($this);
        // echo '</pre>';
        // exit;

        // Assign the values from the form to properties of the user
        $this->name = $data['name'];
        $this->surname = $data['surname'];

        // Only validate and update the email if a value provided
        if ($data['email'] != '') {
            $this->email = $data['email'];
        }

        // Only validate and update the password if a value provided
        if ($data['password'] != '') {
            $this->password = $data['password'];
        }
        $this->password_confirmation = $data['password_confirmation'];

        $this->validate();

        if (empty($this->errors)) {

            $sql = 'UPDATE `users`
                    SET `name` = :name,
                	    `surname` = :surname,
                	    `email` = :email';


            // Add password if it'set
            if (isset($this->password)) {
                $sql .= ", `password_hash` = :password_hash";
            }

            $sql .= "\nWHERE `id` = :id";

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
            $stmt->bindValue(':surname', $this->surname, PDO::PARAM_STR);
            $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

            // Add password if it's set
            if (isset($this->password)) {
                $password_hash = password_hash($this->password, PASSWORD_DEFAULT);
                $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);
            }
            return $stmt->execute();
        }

        return false;
    }

    /**
     * Delete the user's profile
     *  
     * @return boolean True if the data was deleted, false otherwise
     */
    public function deleteUser()
    {
        $sql = 'DELETE FROM `users`
                    WHERE `id` = :id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
