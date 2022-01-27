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
     * Search the book
     * 
     * @return void
     */
    public function searchAction()
    {
        $books = Book::searchBook($_GET['search']);

        if ($books) {
            View::renderTemplate('Books/index.html', [
                'books' => $books
            ]);
        } else {
            Flash::addMessage('Book or author not found, try again', 'warning');

            $this->redirect('/books/index');
        }
    }

    /**
     * Sort the book list by selected parameter
     * 
     * @return void
     */
    public function sortAction()
    {
        if ($_GET['sort'] === 'default') {
            Flash::addMessage('Please select the value from the list', 'warning');
            $this->redirect('/books/index');
        }

        $books = Book::sortBook($_GET['sort']);

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
        $this->requireLibrarianLogin();

        $book = new Book($_POST);

        $authors = Author::getAll();

        if ($book->save()) {

            Flash::addMessage('Book successfully added');

            // Redirect to avoid form resubmission
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
        $this->requireLibrarianLogin();

        $book_id = $this->route_params['id'];
        $authors = Author::getAll();
        $book = Book::findByID($book_id);

        if ($book->updateBook($_POST, $book_id)) {

            Flash::addMessage('Changes saved');

            $this->redirect("/books/index");
        } else {
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
        $this->requireLibrarianLogin();

        $id = $this->route_params['id'];

        $book = Book::findByID($id);

        if ($book->deleteBook()) {

            Flash::addMessage('Book was successfully deleted');

            $this->redirect("/books/index");
        }
    }
}
