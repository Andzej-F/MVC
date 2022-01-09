<?php

namespace App\Controllers;

use \Core\View;

/**
 * Librarians controller
 * 
 * PHP version 8.1.1
 */
class Librarians extends \Core\Controller
{
    // protected $route_params = [
    //     "controller" => "librarians",
    //     "id" => "25",
    //     "action" => "login",
    // ];

    /**
     * Before filter
     * 
     * @return void
     */
    protected function before()
    {
        echo "(before) <br>";
        // return false
    }

    /**
     * After filter
     * 0
     * @return void
     */
    protected function after()
    {
        echo "(after)<br>";
        // return false
    }

    /**
     * Show the index page
     * 
     * @return void
     */
    public function indexAction()
    {
        $this->before();

        echo "Hello from the index action in the Librarians controller";

        $this->after();
    }

    /**
     * Show the login page
     * 
     * @return void
     */
    public function loginAction()
    {
        $this->before();

        // echo "Hello from the login action in the Librarians controller!";
        View::render('Librarians/login.php');

        $this->after();
    }

    /**
     * Logout
     * 
     * @return void
     */
    public function logoutAction()
    {
        $this->before();

        echo "Hello from the logout action in the Librarians controller";

        $this->after();
    }
}
