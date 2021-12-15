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
    //     $this->params = [
    //     "controller" => "posts",
    //     "id" => "12",
    //     "action" => "edit"
    // ];

    /**
     * Before filter
     * 
     * @return void
     */
    protected function before()
    {
        echo "(before)";
        // return true;
    }

    /**
     * After filter
     * 
     * @return void
     */
    protected function after()
    {
        echo "(after)";
        // return true;
    }

    /**
     * Show the index page
     * 
     * @return mixed
     */
    public function indexAction()
    {
        $this->before();

        // echo "Hello from the " . __FUNCTION__ . " action in the " . __CLASS__ . " controller!";
        // echo '<p>Query string parameters: <pre>' .
        //     htmlspecialchars(print_r($_GET, true)) . '</pre></p>';
        // echo '<p>Route parameters: <pre>' .
        //     htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';

        $posts = Post::getAll();

        View::render('Posts/index.php', [
            'posts' => $posts
        ]);

        $this->after();
    }

    /**
     * Show the add new page
     * 
     * @return void
     */
    public function addNewAction()
    {
        $this->before();

        echo "Hello from the " . __FUNCTION__ . " action in the " . __CLASS__ . " controller!";
        echo '<p>Route parameters: <pre>' .
            htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';

        $this->after();
    }

    public function editAction()
    {
        $this->before();

        // echo "Hello from the " . __FUNCTION__ . " action in the " . __CLASS__ . " controller!";
        // echo '<p>Route parameters: <pre>' .
        //     htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';

        $posts = Post::getAll();

        View::render('Posts/edit.php', [
            'posts' => $posts
        ]);

        $this->after();
    }
}
