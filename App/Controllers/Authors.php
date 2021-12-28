<?php

namespace App\Controllers;

use \Core\View;
use \App\Flash;
use \App\Models\Author;

/**
 * Authors controller
 * 
 * PHP version 8.0.7
 */
class Authors extends \Core\Controller
{
    /**
     * Show the index page
     * 
     * @return void
     */
    public function indexAction()
    {
        $authors = Author::getAll();

        View::render('Authors/index.php', [
            'authors' => $authors
        ]);
    }

    /**
     * Show the create new author page
     * 
     * @return void
     */
    public function newAction()
    {
        $this->requireLogin();

        View::render('Authors/new.php');
    }

    /**
     * Add a new author
     * 
     * @return void
     */
    public function createAction()
    {
        $this->requireLogin();

        $author = new Author($_POST);

        if ($author->save()) {

            // Redirect to avoid form resubmission
            $this->redirect('/authors/success');
        } else {

            View::render('Authors/new.php', [
                'author' => $author
            ]);
        }
    }

    /**
     * Show the create author success page
     * 
     * @return void
     */
    public function successAction()
    {
        View::render('Authors/success.php');
    }

    // if ($author->save()) {

    //     Flash::addMessage('Author successfully added');

    //     $this->redirect('/authors/index');
    // } else {
    //     View::render('Authors/create.php', [
    //         'author' => $author
    //     ]);
    // }
    // }

    /**
     * Edit the author
     * 
     * @return void
     */
    public function editAction()
    {
        $this->requireLogin();

        $id = $this->route_params['id'];

        // Get the author object
        $author = Author::getAuthor($id);

        echo '<pre>';
        print_r($author);
        echo '</pre>';

        View::render('Authors/edit.php', [
            'author' => $author
        ]);
    }

    /**
     * Update the author information
     * 
     * @return void
     */
    public function updateAction()
    {
        $this->requireLogin();

        $id = $this->route_params['id'];

        // // // Get the author object
        $author = Author::getAuthor($id);

        echo gettype($author);

        echo '<pre>';
        print_r($author);
        echo '</pre>';

        echo '<pre>';
        print_r($_POST);
        echo '</pre>';

        // if ($author->updateAuthor($_POST)) {

        //     Flash::addMessage('Changes saved');

        //     $this->redirect("/authors/index");
        // } else {
        //     // Redisplay the form passing in the user model as this will contain
        //     // any validation error messages to display back in the form
        //     View::render('Authors/edit.php', [
        //         'author' => $author
        //     ]);
        // }
    }

    // /**
    //  * Delete the author
    //  * 
    //  * @return void
    //  */
    // public function deleteAction()
    // {
    //     $this->requireLogin();

    //     View::render('Authors/delete.php');
    // }
}
