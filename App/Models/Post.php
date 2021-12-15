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
            //    $db=PDO Object
            // (
            // )

            $stmt = $db->query('SELECT id, title, content FROM posts
                                ORDER BY created_at');
            // $stmt=PDOStatement Object
            // (
            //     [queryString] => SELECT id, title, content FROM posts
            //                                 ORDER BY created_at
            // )

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // $results= Array
            // (
            //     [0] => Array
            //         (
            //             [id] => 1
            //             [title] => First post
            //             [content] => This is a really interesting post.
            //         )

            //     [1] => Array
            //         (
            //             [id] => 2
            //             [title] => Second post
            //             [content] => This is a fascinating post.
            //         )

            //     [2] => Array
            //         (
            //             [id] => 3
            //             [title] => Third post
            //             [content] => This is a very informative post.
            //         )

            // )
            return $results;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
