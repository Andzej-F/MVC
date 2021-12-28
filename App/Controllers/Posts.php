<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Post;

/**
 * Posts controller
 * 
 * PHP version 8.0.7
 */
class Posts extends \Core\Controller
{

    /**
     * Show the index page
     * 
     * @return mixed
     */
    public function indexAction()
    {

        $posts = Post::getAll();

        View::render('Posts/index.php', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the add new page
     * 
     * @return void
     */
    public function addNewAction()
    {

        echo "Hello from the " . __FUNCTION__ . " action in the " . __CLASS__ . " controller!";
        echo '<p>Route parameters: <pre>' .
            htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';
    }

    public function editAction()
    {

        $posts = Post::getAll();

        View::render('Posts/edit.php', [
            'posts' => $posts
        ]);
    }
}
