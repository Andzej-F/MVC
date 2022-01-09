<?php

namespace App\Controllers;

/**
 * Readers controller
 * 
 * PHP version 8.1.1
 */
class Readers extends \Core\Controller
{
    /**
     * Show the index ("reader settings") page
     * 
     * @return void
     */
    public function index()
    {
        echo "Hello from the " . __FUNCTION__ . " action in the " . __CLASS__ . " controller!";
    }

    /**
     * Show the signup form
     * 
     * @return void
     */
    public function signup()
    {
        echo "Hello from the " . __FUNCTION__ . " action in the " . __CLASS__ . " controller!";
    }

    /**
     * Show the login page
     * 
     * @return void
     */
    public function login()
    {
        echo "Hello from the " . __FUNCTION__ . " action in the " . __CLASS__ . " controller!";
    }

    /**
     * Logout
     * 
     * @return void
     */
    public function logout()
    {
        echo "Hello from the " . __FUNCTION__ . " action in the " . __CLASS__ . " controller!";
    }

    /**
     * Edit reader's account
     * 
     * @return void
     */
    public function edit()
    {
        echo "Hello from the " . __FUNCTION__ . " action in the " . __CLASS__ . " controller!";
    }

    /**
     * Delete the account
     * 
     * @return void
     */
    public function delete()
    {
        echo "Hello from the " . __FUNCTION__ . " action in the " . __CLASS__ . " controller!";
    }
}
