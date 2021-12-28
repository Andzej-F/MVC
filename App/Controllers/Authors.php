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
        View::render('Authors/index.php');
    }

    /**
     * Add a new author
     * 
     * @return void
     */
    public function createAction()
    {
        // TODO create method $this->requireLibrarianLogin();
        $this->requireLogin();

        $author = new Author($_POST);

        if ($author->save()) {

            Flash::addMessage('Author successfully added');

            $this->redirect('/authors/index');
        } else {
            View::render('Authors/create.php', [
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
        $this->requireLogin();

        View::render('Authors/edit.php');
    }

    /**
     * Delete the author
     * 
     * @return void
     */
    public function deleteAction()
    {
        $this->requireLogin();

        View::render('Authors/delete.php');
    }
}
