<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;

/**
 * Profile controller
 * 
 * PHP version 8.1.1
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
        if (!isset($user)) {
            $this->requireLogin();
        }

        View::renderTemplate(
            'Profile/show.html',
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

        View::renderTemplate(
            'Profile/edit.html',
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

        if ($user->updateProfile($_POST)) {

            Flash::addMessage('Changes saved');

            $this->redirect("/profile/show");
        } else {
            // Redisplay the form passing in the user model as this will contain
            // any validation error messages to display back in the form
            View::renderTemplate('Profile/edit.html', [
                'user' => $user
            ]);
        }
    }

    /**
     * Delete the author
     * 
     * @return void
     */
    public function deleteAction()
    {
        $this->requireLogin();

        $user = Auth::getUser();

        if ($user->deleteUser()) {

            Flash::addMessage('User was successfully deleted');

            $this->redirect("/");
        }
    }

    /**
     * Add borrowed book to the list and display in profile page
     * 
     * @return void
     */
    public function borrowAction()
    {
        $this->requireLogin();

        // echo '<pre>';
        // print_r($this);
        // echo '</pre>';
        // // exit;

        $book_id = $this->route_params['id'];
        echo $book_id;
        // exit;

        // Get the user object
        $user = Auth::getUser();

        // TODO reikia kad nutu neaktyvus linkas kai available lygu 0


        echo '<pre>';
        print_r($user);
        echo '</pre>';

        // $user->borrowBook($book_id);
        // check if book is not already borrowed

        exit;

        if ($user->updateProfile($_POST)) {

            Flash::addMessage('Changes saved');

            $this->redirect("/profile/show");
        } else {
            // Redisplay the form passing in the user model as this will contain
            // any validation error messages to display back in the form
            View::renderTemplate('Profile/edit.html', [
                'user' => $user
            ]);
        }
    }
}
