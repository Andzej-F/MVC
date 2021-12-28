<?php

namespace App\Models;

use PDO;

/**
 * Post model
 * 
 * PHP version 8.0.7
 */
class Post extends \Core\Model
{
    /**
     * Get al the posts as an associative array
     * 
     * @return array
     */
    public static function getAll()
    {

        try {
            $db = static::getDB();

            $stmt = $db->query('SELECT id, title, content FROM posts
                                ORDER BY created_at');

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
