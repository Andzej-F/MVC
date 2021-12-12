<?php

namespace App\Controllers;

/**
 * Books controller
 * 
 * PHP version 8.0.7
 */
class Books extends \Core\Controller
{
    /**
     * Show the index page
     * 
     * @return void
     */
    public function index()
    {
        echo "Hello from the " . __FUNCTION__ . " action in the " . __CLASS__ . " controller!";
    }

    /**
     * Add a book
     * 
     * @return void
     */
    public function add()
    {
        echo "Hello from the " . __FUNCTION__ . " action in the " . __CLASS__ . " controller!";
    }

    /**
     * Edit the book
     * 
     * @return void
     */
    public function edit()
    {
        echo "Hello from the " . __FUNCTION__ . " action in the " . __CLASS__ . " controller!";
    }

    /**
     * Delete the book
     * 
     * @return void
     */
    public function delete()
    {
        echo "Hello from the " . __FUNCTION__ . " action in the " . __CLASS__ . " controller!";
    }

    /**
     * Write the book's review
     * 
     * @return void
     */
    public function review()
    {
        echo "Hello from the " . __FUNCTION__ . " action in the " . __CLASS__ . " controller!";
    }

    /**
     * Rate the book from 1 to 10
     * 
     * @return void
     */
    public function rating()
    {
        echo "Hello from the " . __FUNCTION__ . " action in the " . __CLASS__ . " controller!";
    }
}
