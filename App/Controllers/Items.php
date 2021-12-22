<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;

/**
 * Items controller (example)
 * 
 * PHP version 8.0.7
 */
class Items extends \Core\Controller
{
    /**
     * Before filter
     * 
     * @return void
     */
    protected function before()
    {
    }

    /**
     * After filter
     * 
     * @return void
     */

    protected function after()
    {
    }

    /**
     * Items index
     * 
     * @return void
     */
    public function indexAction()
    {
        // if (!Auth::isLoggedIn()) {
        //     // exit("access denied");

        //     Auth::rememberRequestedPage();

        //     $this->redirect('/login');
        // }
        $this->requireLogin();

        View::render('Items/index.php');
    }

    /**
     * Add a new item
     * 
     * @return void
     */
    public function newAction()
    {
        $this->requireLogin();

        echo "new action";
    }

    /**
     * Show an item
     * 
     * @return void
     */
    public function showAction()
    {
        $this->requireLogin();

        echo "show action";
    }
}
