<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/**
 * Signup controller
 * 
 * PHP version 8.1.1
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
        // View::render('Signup/new.php');
        View::renderTemplate('Signup/new.html');
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
            // header('Location: http://localhost/PHP/lbm2/public/signup/success', true, 303);
            // exit;
            $this->redirect('/signup/success');
        } else {

            View::renderTemplate('Signup/new.html', [
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
        View::renderTemplate('Signup/success.html');
    }
}
