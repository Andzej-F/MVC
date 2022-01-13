<?php

namespace App\Controllers;

use \Core\View;
use \App\Flash;
use \App\Models\Author;
use \App\Models\Book;

/**
 * Books controller
 * 
 * PHP version 8.1.1
 */
class Books extends \Core\Controller
{
    /**
     * Show the index page
     * 
     * @return void
     */
    public function indexAction()
    {
        $books = Book::getAll();

        View::renderTemplate('Books/index.html', [
            'books' => $books
        ]);
    }

    /**
     * Show the create new book page
     * 
     * @return void
     */
    public function newAction()
    {
        // $this->requireLogin();

        $this->requireLibrarianLogin();


        $authors = Author::getAll();

        View::renderTemplate('Books/new.html', [
            'authors' => $authors
        ]);
    }

    /**
     * Add a new book
     * 
     * @return void
     */
    public function createAction()
    {
        // $this->requireLogin();
        $this->requireLibrarianLogin();


        $book = new Book($_POST);

        $authors = Author::getAll();

        if ($book->save()) {

            // Redirect to avoid form resubmission
            Flash::addMessage('Book successfully added');

            $this->redirect('/books/index');
        } else {

            View::renderTemplate('Books/new.html', [
                'book' => $book,
                'authors' => $authors
            ]);
        }
    }

    /**
     * Edit the book
     * 
     * @return void
     */
    public function editAction()
    {
        // $this->requireLogin();
        $this->requireLibrarianLogin();


        $id = $this->route_params['id'];

        $authors = Author::getAll();
        $book = Book::findByID($id);

        View::renderTemplate('Books/edit.html', [
            'book' => $book,
            'authors' => $authors
        ]);
    }

    /**
     * Update the book information
     * 
     * @return void
     */
    public function updateAction()
    {
        // $this->requireLogin();
        $this->requireLibrarianLogin();


        $book_id = $this->route_params['id'];
        $authors = Author::getAll();
        $book = Book::getBook($book_id);

        if ($book->updateBook($_POST, $book_id)) {

            Flash::addMessage('Changes saved');

            $this->redirect("/books/index");
        } else {
            // Redisplay the form passing in the book model as this will contain
            // any validation error messages to display back in the form
            View::renderTemplate('Books/edit.html', [
                'book' => $book,
                'authors' => $authors
            ]);
        }
    }

    /**
     * Delete the book
     * 
     * @return void
     */
    public function deleteAction()
    {
        // $this->requireLogin();
        $this->requireLibrarianLogin();


        $id = $this->route_params['id'];

        $book = Book::getBook($id);

        if ($book->deleteBook()) {

            Flash::addMessage('Book was successfully deleted');

            $this->redirect("/books/index");
        }
    }
}
