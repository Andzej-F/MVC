<?php

namespace App\Controllers;

/**
 * Authors controller
 * 
 * PHP version 8.0.7
 */
class Authors extends \Core\Controller
{
    /**
     * Show the index page
     * 
     * @return void
     */
    public function index()
    {
        echo "Hello from the " . __FUNCTION__ . " action in the " . __CLASS__ . " controller!";
        echo '<p>Route parameters: <pre>' .
            htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';
    }

    /**
     * Add a new author
     * 
     * @return void
     */
    public function add()
    {
        echo "Hello from the " . __FUNCTION__ . " action in the " . __CLASS__ . " controller!";
    }

    /**
     * Edit the author
     * 
     * @return void
     */
    public function edit()
    {
        echo "Hello from the " . __FUNCTION__ . " action in the " . __CLASS__ . " controller!";
    }

    /**
     * Delete the author
     * 
     * @return void
     */
    public function delete()
    {
        echo "Hello from the " . __FUNCTION__ . " action in the " . __CLASS__ . " controller!";
    }

    /**
     * Rate the author from 1 to 10
     * 
     * @return void
     */
    public function rating()
    {
        echo "Hello from the " . __FUNCTION__ . " action in the " . __CLASS__ . " controller!";
    }
}
