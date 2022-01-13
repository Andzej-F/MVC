<?php

namespace App\Models;

use PDO;
use \App\Models\Author;

/**
 * Book model
 * 
 * PHP version 8.1.1
 */
class Book extends \Core\Model
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
     * Display the list of books available in database
     * 
     * @return array Return the list of books
     */
    public static function getAll()
    {
        // $sql = 'SELECT * FROM `books` WHERE 1
        //         ORDER BY `title`';

        $sql = 'SELECT * FROM `books` 
                INNER JOIN `authors`
                ON `books`.`author_id` = `authors`.`author_id`
                ORDER BY `title`';

        $db = static::getDB();

        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();

        // $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $result = $stmt->fetchALL();

        return $result;
    }

    /**
     * Display the specific book based on id
     * 
     * @return array Returns Book object on success, false on failure
     */
    public static function getBook($book_id)
    {
        $sql = 'SELECT * FROM `books` WHERE `book_id` =:book_id';

        $db = static::getDB();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':book_id', $book_id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * Save the books model with the current property values
     * 
     * @return boolean Return true on success or false on failure.
     */
    public function save()
    {
        $this->validate();

        if (empty($this->errors)) {

            $sql = 'INSERT INTO `books`(`title`, `author_id`, `genre`, `available`, `borrowed`)
                    VALUES (:title, :author_id, :genre, :available, :borrowed)';

            $db = static::getDB();

            $stmt = $db->prepare($sql);

            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':author_id', $this->author_id, PDO::PARAM_INT);
            $stmt->bindValue(':genre', $this->genre, PDO::PARAM_STR);
            $stmt->bindValue(':available', $this->available, PDO::PARAM_INT);
            $stmt->bindValue(':borrowed', $this->borrowed, PDO::PARAM_INT);

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
        // Title
        $this->title = trim($this->title);

        if ($this->title == '') {
            $this->errors[] = 'Error: Title is required';
        }

        if (!preg_match('/^[a-zA-z ,.!().?";\'-]+$/i', $this->title)) {
            $this->errors[] = 'Error: Title contains not valid characters';
        }

        if (mb_strlen($this->title) > 255) {
            $this->errors[] = 'Error: Title is too long';
        }

        // Author_id
        if ($this->author_id === 'default') {
            $this->errors[] = 'Error: Please select the author from the list';
        }

        // elseif ($this->bookExists($this->title, $this->author_id)) {
        //     $this->errors[] = 'Error: This author\'s book is present in the records ';
        // }

        // Genre
        $this->genre = trim($this->genre);

        if (
            $this->genre == ''
        ) {
            $this->errors[] = 'Error: Genre is required';
        }

        if (!preg_match('/^[a-zA-z ,.!().?";\'-]+$/i', $this->genre)) {
            $this->errors[] = 'Error: Genre contains not valid characters';
        }

        if (mb_strlen($this->genre) > 64) {
            $this->errors[] = 'Error: Genre name is too long';
        }

        // Author_id
        if ($this->author_id === 'default') {
            $this->errors[] = 'Error: Please select the author from the list';
        }
        //  elseif ($this->bookExists($this->title, $this->author_id)) {
        //     $this->errors[] = 'Error: This author\'s book is present in the records ';
        // }

        // Available
        $this->available = trim($this->available);

        if ($this->available == '') {
            $this->errors[] = 'Error: Available number is required';
        }

        if (!is_numeric($this->available)) {
            $this->errors[] = 'Error: Available number must be of integer type';
        } elseif ($this->available < 0) {
            $this->errors[] = 'Error: Available number must be positive';
        } elseif ($this->available > 99) {
            $this->errors[] = 'Error: Available number cannot exceed the 99';
        }

        // Borrowed
        $this->borrowed = trim($this->borrowed);

        if ($this->borrowed == '') {
            $this->errors[] = 'Error: Borrowed number is required';
        }

        if (!is_numeric($this->borrowed)) {
            $this->errors[] = 'Error: Borrowed number must be of integer type';
        } elseif ($this->borrowed < 0) {
            $this->errors[] = 'Error: Borrowed number must be positive';
        } elseif ($this->borrowed > 99) {
            $this->errors[] = 'Error: Borrowed number cannot exceed the 99';
        }
    }

    /**
     * See if a book record already exists with the specified title and author's name and surname
     * 
     * @param string $name name to search for
     * @param string $surname surname to search for
     * 
     * @return boolean True if a record already exists with the specified name and surname,
     * false otherwise
     */
    public static function bookExists($title, $author_id)
    {
        $author = Author::getAuthor($author_id);

        $sql = 'SELECT * FROM `books` 
                INNER JOIN `authors`
                ON `books`.`author_id` = `authors`.`author_id`
                WHERE `title`= :title
                AND `name`= :name
                AND `surname`= :surname';


        $db = static::getDB();

        $stmt = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':name', $author->name, PDO::PARAM_STR);
        $stmt->bindValue(':surname', $author->surname, PDO::PARAM_STR);

        // $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\Models\User');
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }


    /**
     * Find the book model by ID
     * 
     * @param string $book_id The book ID
     * 
     * @return mixed Book object if found, false otherwise
     */
    public static function findByID($book_id)
    {
        $sql = 'SELECT * FROM `books` WHERE book_id = :book_id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':book_id', $book_id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * Update the books information
     * 
     * @param array $data Data from the edit profile form
     * 
     * @return boolean True if the data was updated, false otherwise
     */
    public function updateBook($data)
    {
        // Assign the values from the form to properties of the book
        $this->title = $data['title'];
        $this->author_id = $data['author_id'];
        $this->genre = $data['genre'];
        $this->available = $data['available'];
        $this->borrowed = $data['borrowed'];

        $this->validate();

        if (empty($this->errors)) {

            $sql = 'UPDATE `books`
                    SET `title` = :title,
                        `author_id` = :author_id,
                        `genre` = :genre,
                        `available` = :available,
                        `borrowed` = :borrowed
                    WHERE `book_id` = :book_id';


            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':author_id', $this->author_id, PDO::PARAM_INT);
            $stmt->bindValue(':genre', $this->genre, PDO::PARAM_STR);
            $stmt->bindValue(':available', $this->available, PDO::PARAM_INT);
            $stmt->bindValue(':borrowed', $this->borrowed, PDO::PARAM_INT);
            $stmt->bindValue(':book_id', $this->book_id, PDO::PARAM_INT);

            return $stmt->execute();
        }

        return false;
    }

    /**
     * Delete the book
     *  
     * @return boolean True if the data was deleted, false otherwise
     */
    public function deleteBook()
    {
        $sql = 'DELETE FROM `books`
                WHERE `book_id` = :book_id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':book_id', $this->book_id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Find searched book
     * 
     * @return array Returns Book object on success, false on failure
     */
    public static function searchBook($search)
    {
        $sql = 'SELECT * FROM `books`
                    INNER JOIN `authors` ON `books`.`author_id`=`authors`.`author_id`
                    WHERE `title`LIKE :search
                    OR `name` LIKE :search
                    OR `surname` LIKE :search';

        $db = static::getDB();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        // $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetchAll();
    }
}
