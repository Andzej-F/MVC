<?php

namespace App\Controllers;

use \Core\View;

/**
 * Home controller
 * 
 * PHP version 8.0.7
 */
class Home extends \Core\Controller
{

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
        // echo "Hello from the " . __FUNCTION__ . " action in the " . __CLASS__ . " controller!";
        View::render('Home/index.php', [
            'name' => 'Dave',
            'colours' => ['red', 'green', 'blue']
        ]);
    }
}
