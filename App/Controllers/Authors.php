<?php

namespace App\Controllers;

use \Core\View;
use \App\Flash;
use \App\Models\Author;

/**
 * Authors controller
 * 
 * PHP version 8.1.1
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

        View::renderTemplate('Authors/index.html', [
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
        $this->requireLibrarianLogin();

        View::renderTemplate('Authors/new.html');
    }

    /**
     * Add a new author
     * 
     * @return void
     */
    public function createAction()
    {
        $this->requireLibrarianLogin();

        $author = new Author($_POST);

        if ($author->save()) {

            // Redirect to avoid form resubmission
            Flash::addMessage('Author successfully added');

            $this->redirect('/authors/index');
        } else {

            View::renderTemplate('Authors/new.html', [
                'author' => $author
            ]);
        }
    }

    /**
     * Edit the author
     * 
     * @return void
     */
    public function editAction()
    {
        // $this->requireLogin();
        $this->requireLibrarianLogin();

        $author_id = $this->route_params['id'];

        $author = Author::getAuthor($author_id);

        View::renderTemplate('Authors/edit.html', [
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
        // $this->requireLogin();
        $this->requireLibrarianLogin();

        $author_id = $this->route_params['id'];

        $author = Author::getAuthor($author_id);

        if ($author->updateAuthor($_POST)) {

            Flash::addMessage('Changes saved');

            $this->redirect("/authors/index");
        } else {
            // Redisplay the form passing in the user model as this will contain
            // any validation error messages to display back in the form
            View::renderTemplate('Authors/edit.html', [
                'author' => $author
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
        // $this->requireLogin();
        $this->requireLibrarianLogin();


        $author_id = $this->route_params['id'];

        $author = Author::getAuthor($author_id);

        if ($author->deleteAuthor()) {

            Flash::addMessage('Author was successfully deleted');

            $this->redirect("/authors/index");
        }
    }
}
