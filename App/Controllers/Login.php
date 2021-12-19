<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/**
 * Login controller
 * 
 * PHP version 8.0.7
 */
class Login extends \Core\Controller
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
     * Show the login page
     * 
     * @return void
     */
    public function newAction()
    {
        View::render('Login/new.php');
    }

    /**
     * Log in a user
     * 
     * @return void 
     */
    public function createAction()
    {
        // echo ($_REQUEST['email'] . ', ' . $_REQUEST['password']);
        $user = User::findByEmail($_POST['email']);
        echo '<pre>';
        var_dump($user);
        echo '</pre>';
    }
}
