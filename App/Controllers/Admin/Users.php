<?php

namespace App\Controllers\Admin;

/**
 * User admin controller
 * 
 * PHP version 8.0.7
 */
class Users extends \Core\Controller
{
    // protected $route_params = ["namespace" => "Admin", "controller" => "users", "action" => "index"];

    /**
     * Before filter
     * 
     * @return boolean
     */
    protected function before()
    {
        // Make sure an admin user is logged in for example
        echo "(before) <br>";
        // return true;
    }

    /**
     * After filter
     * 
     * @return mixed
     */
    protected function after()
    {
        echo "<br>(after)<br>";
        // return true;
    }

    /**
     * Show the index page
     * 
     * @return void
     */
    public function indexAction()
    {
        $this->before();
        echo "User admin index";
        $this->after();
    }
}
