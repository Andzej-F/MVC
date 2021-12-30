<?php

namespace App\Models;

use PDO;

/**
 * Author model
 * 
 * PHP version 8.0.7
 */
class Author extends \Core\Model
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
     * Display the list of authors available in database
     * 
     * @return array Return array of authors
     */
    public static function getAll()
    {
        $sql = 'SELECT * FROM `authors` WHERE 1
                ORDER BY `surname`';

        $db = static::getDB();

        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;
    }

    /**
     * Display the specific author's information selected by id value
     * 
     * @return mixed Author object on success or false on failure
     */
    public static function getAuthor($author_id)
    {
        $sql = 'SELECT * FROM `authors` WHERE `author_id` =:author_id';

        $db = static::getDB();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':author_id', $author_id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * Save the author model with the current property values
     * 
     * @return boolean Return true on success or false on failure.
     */
    public function save()
    {
        $this->validate();

        if (empty($this->errors)) {

            $sql = 'INSERT INTO `authors`(`name`, `surname`)
                    VALUES (:name, :surname)';

            $db = static::getDB();

            $stmt = $db->prepare($sql);

            $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
            $stmt->bindValue(':surname', $this->surname, PDO::PARAM_STR);

            // "PDOStatement::execute" method returns true on success or false on failure.
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
        $this->name = trim($this->name);

        if ($this->name == '') {
            $this->errors[] = 'Error: Name is required';
        }

        if (!preg_match('/^[a-zA-z ,.!().?";\'-]+$/i', $this->name)) {
            $this->errors[] = 'Error: Name contains not valid characters';
        }

        if ($this->name != ucwords($this->name, " \t\r\n\f\v")) {
            $this->errors[] = 'Error: Name must begin with a capital letter';
        }

        if (mb_strlen($this->name) > 64) {
            $this->errors[] = 'Error: Name is too long';
        }

        // Surname
        $this->surname = trim($this->surname);

        if ($this->surname == '') {
            $this->errors[] = 'Error: Surname is required';
        }

        if (!preg_match('/^[a-zA-z ,.!().?";\'-]+$/i', $this->surname)) {
            $this->errors[] = 'Error: Surname contains not valid characters';
        }

        if ($this->surname != ucwords($this->surname, " \t\r\n\f\v")) {
            $this->errors[] = 'Error: Surname must begin with a capital letter';
        }

        if (mb_strlen($this->surname) > 64) {
            $this->errors[] = 'Error: Surname is too long';
        }

        // Author
        if ($this->authorExists($this->name, $this->surname)) {
            $this->errors[] = 'Error: Author is present in the records ';
        }
    }

    /**
     * See if the author record already exists with the specified name and surname
     * 
     * @param string $name author's name to search for
     * @param string $surname author's surname to search for
     * 
     * @return mixed Returns an instance of Author class if a record already exists,
     *  false otherwise
     */
    public static function authorExists($name, $surname)
    {
        $sql = 'SELECT * FROM `authors` 
                WHERE `name` = :name
                AND `surname` = :surname';

        $db = static::getDB();

        $stmt = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':surname', $surname, PDO::PARAM_STR);

        // $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\Models\User');
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }


    /**
     * Find a author model by ID
     * 
     * @param string $author_id The author ID
     * 
     * @return mixed Author object if found, false otherwise
     */
    public static function findByID($author_id)
    {
        $sql = 'SELECT * FROM `authors` WHERE author_id = :author_id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':author_id', $author_id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * Update the authors's profile
     * 
     * @param array $data Data from the edit profile form
     * 
     * @return boolean True if the data was updated, false otherwise
     */
    public function updateAuthor($data)
    {
        // Assign the values from the form to properties of the author
        $this->name = $data['name'];
        $this->surname = $data['surname'];

        $this->validate();

        if (empty($this->errors)) {

            $sql = 'UPDATE `authors`
                    SET `name` = :name,
                        `surname` = :surname
                    WHERE `author_id` = :author_id';


            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
            $stmt->bindValue(':surname', $this->surname, PDO::PARAM_STR);
            $stmt->bindValue(':author_id', $this->author_id, PDO::PARAM_INT);

            return $stmt->execute();
        }

        return false;
    }

    /**
     * Delete the authors's profile
     *  
     * @return boolean True if the data was deleted, false otherwise
     */
    public function deleteAuthor()
    {
        $sql = 'DELETE FROM `authors`
                    WHERE `author_id` = :author_id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':author_id', $this->author_id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
