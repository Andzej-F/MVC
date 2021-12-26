<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;

/**
 * Profile controller
 * 
 * PHP version 8.0.7
 */
class Profile extends \Core\Controller
{
    /**
     * Show the profile
     * 
     * @return void
     */
    public function showAction()
    {
        $this->requireLogin();

        View::render(
            'Profile/show.php',
            [
                'user' => Auth::getUser()
            ]
        );
    }

    /**
     * Show the form for editing the profile
     * 
     * @return void
     */
    public function editAction()
    {
        $this->requireLogin();

        View::render(
            'Profile/edit.php',
            [
                'user' => Auth::getUser()
            ]
        );
    }

    /**
     * Update the profile
     * 
     * @return void
     */
    public function updateAction()
    {
        $this->requireLogin();

        // Get the user object
        $user = Auth::getUser();

        //TODO Debug
        echo '<pre>';
        print_r($user);
        var_dump($user);
        echo '</pre>';

        if ($user->updateProfile($_POST)) {

            //TODO Debug
            echo '<pre>';
            print_r($_POST);
            var_dump($_POST);
            echo '</pre>';

            Flash::addMessage('Changes saved');

            $this->redirect("/profile/show");
        } else {
            // Redisplay the form passing in the user model as this will contain
            // any validation error messages to display back in the form
            View::render('Profile/edit.php', [
                'user' => $user
            ]);
        }
    }
}
