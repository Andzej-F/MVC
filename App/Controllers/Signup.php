<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/**
 * Signup controller
 * 
 * PHP version 8.0.7
 */
class Signup extends \Core\Controller
{
    /**
     * Show the signup page
     * 
     * @return void;
     */
    public function newAction()
    {
        View::render('Signup/new.php');
    }

    /**
     * Sign up a new user
     * 
     * @return void
     */
    public function createAction()
    {
        // Automatically will execute the class constructor
        $user = new User($_POST);

        if ($user->save()) {
            // View::render('Signup/success.php');
            $this->redirect('/signup/success');
        } else {

            View::render('Signup/new.php', [
                'user' => $user
            ]);
        }
    }

    /**
     * Show the signup success page
     * 
     * @return void
     */
    public function successAction()
    {
        View::render('Signup/success.php');
    }
}
