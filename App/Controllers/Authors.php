<?php

namespace App\Controllers;

use \Core\View;
use \App\Flash;
use \App\Paginator;
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
        // $authors = Author::getAll();

        // View::renderTemplate('Authors/index.html', [
        //     'authors' => $authors
        // ]);

        $limit = (isset($_GET['limit'])) ? $_GET['limit'] : 10;
        $page  = (isset($_GET['page'])) ? $_GET['page'] : 1;
        $links = (isset($_GET['links'])) ? $_GET['links'] : 2;

        $authors = Author::getAll($limit, $page);
        $total = Paginator::getTotalRows('authors');
        $pagination_links = Paginator::createLinks($limit, $page, $links, $total);

        View::renderTemplate('Authors/index.html', [
            'authors' => $authors,
            'pagination_links' => $pagination_links
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
        $this->requireLibrarianLogin();

        $author_id = $this->route_params['id'];

        $author = Author::findByID($author_id);

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
        $this->requireLibrarianLogin();

        $author_id = $this->route_params['id'];

        $author = Author::findByID($author_id);

        if ($author->updateAuthor($_POST)) {

            Flash::addMessage('Changes saved');

            $this->redirect("/authors/index");
        } else {
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
        $this->requireLibrarianLogin();

        $author_id = $this->route_params['id'];

        $author = Author::findByID($author_id);

        if ($author->deleteAuthor()) {

            Flash::addMessage('Author was successfully deleted');

            $this->redirect("/authors/index");
        }
    }
}
