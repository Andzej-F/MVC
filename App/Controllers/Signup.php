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
     * Before action filter
     * 
     * @return void;
     */
    protected function before()
    {
    }

    /**
     * After action filter
     * 
     * @return void;
     */
    protected function after()
    {
    }

    /**
     * Show the signup page
     * 
     * @return void;
     */
    public function newAction()
    {
        $this->before();

        View::render('Signup/new.php');

        $this->after();
    }

    /**
     * Sign up a new user
     * 
     * @return void
     */
    public function createAction()
    {
        // echo '<pre>';
        // var_dump($_POST);
        // print_r($_POST);
        // echo '</pre>';
        // Automatically will execute the class constructor

        $user = new User($_POST);
        // $user = new User([
        //     "name" => "Dave",
        //     "email" => "dave@example.com",
        //     "password" => "secret",
        //     "password_confirmation" => "secret"
        // ]);

        if ($user->save()) {

            View::render('Signup/success.php');
        } else {

            View::render('Signup/new.php', [
                'user' => $user
            ]);
        }
    }
}

// echo '<pre>';
// var_dump($user);
// print_r($user);
// echo '</pre>';
