<?php

namespace App\Controllers;

/**
 * Librarians controller
 * 
 * PHP version 8.0.7
 */
class Librarians extends \Core\Controller
{
    /**
     * Show the index page
     * 
     * @return void
     */
    public function index()
    {
        echo "Hello from the index action in the Librarians controller";
    }

    /**
     * Show the login page
     * 
     * @return void
     */
    public function login()
    {
        echo "Hello from the login action in the Librarians controller!";
    }

    /**
     * Logout
     * 
     * @return void
     */
    public function logout()
    {
        echo "Hello from the logout action in the Librarians controller";
    }
}
