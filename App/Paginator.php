<?php

namespace App;

use \App\Models\Author;
use \App\Models\Book;

class Paginator extends \Core\Model
{
    /**
     * Display the list of authors available in the database
     * 
     * @return array Return array of authors
     */
    public static function getAll($limit, $page)
    {
        $sql = 'SELECT * FROM `authors` WHERE 1 ORDER BY `surname`';

        if ($limit == 'all') {
            $sql = $sql;
        } else {
            $sql = $sql . " LIMIT " . (($page - 1) * $limit) . ", $limit";
        }

        echo $sql;

        $db = static::getDB();

        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $results = $stmt->fetchAll();

        $total = parent::getNumberOfRows('users');

        // while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        //     $results[]  = $row;
        // }

        $result         = new \stdClass();
        $result->page   = $page;
        $result->limit  = $limit;
        $result->total  = $total;
        $result->data   = $results;

        // return $result;
        // echo '<pre>';
        // print_r($result);
        // echo '</pre>';
        // exit;

        return $result;
    }

    /**
     * Display the number of rows in a selected table
     * 
     * @return int Returns number of rows in table
     */
    public static function getNumberOfRows($table_name)
    {
        $sql = 'SELECT * FROM `';
        $sql .= $table_name . '` WHERE 1';

        $db = static::getDB();

        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        return $stmt->rowCount();
    }
}
