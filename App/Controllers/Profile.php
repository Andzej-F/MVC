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
        $this->requireLogin();

        $user = Auth::getUser();

        View::renderTemplate(
            'Profile/show.html',
            [
                'user' => $user,
                'user_books' => $user->getUserBooks()
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

        $user = Auth::getUser();

        if ($user->updateProfile($_POST)) {

            Flash::addMessage('Changes saved');

            $this->redirect("/profile/show");
        } else {
            View::renderTemplate('Profile/edit.html', [
                'user' => $user
            ]);
        }
    }

    /**
     * Delete the account
     * 
     * @return void
     */
    public function deleteAction()
    {
        $this->requireLogin();

        $user = Auth::getUser();

        if ($user->borrowCount() === 0) {
            if ($user->deleteUser()) {

                Flash::addMessage('User was successfully deleted');

                $this->redirect("/");
            }
        } else {
            Flash::addMessage('Profile cannot be deleted, unless all the books are returned', 'warning');

            $this->redirect("/profile/show");
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

        $user = Auth::getUser();

        $book_id = $this->route_params['id'];

        if ($user->isBookTaken($book_id) === true) {

            Flash::addMessage('The book is already taken by you', 'warning');

            $this->redirect('/books/index');
        }

        if ($user->borrowCount() >= 3) {

            Flash::addMessage('You are allowed to borrow up to 3 books', 'warning');

            $this->redirect("/books/index");
        }

        $user->borrowBook($book_id);

        Flash::addMessage('Book has been successfully borrowed');

        $this->redirect("/profile/show");
    }

    /**
     * Add borrowed book to the list and display in profile page
     * 
     * @return void
     */
    public function returnAction()
    {
        $this->requireLogin();

        $user = Auth::getUser();

        $book_id = $this->route_params['id'];

        $user->returnBook($book_id);

        Flash::addMessage('Book has been successfully returned');

        $this->redirect("/books/index");
    }
}
