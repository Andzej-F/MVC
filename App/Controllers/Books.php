<?php

namespace App\Controllers;

use \Core\View;
use \App\Flash;
use \App\Models\Author;
use \App\Models\Book;

/**
 * Books controller
 * 
 * PHP version 8.0.7
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

        View::render('Books/index.php', [
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
        $this->requireLogin();

        $authors = Author::getAll();

        View::render('Books/new.php', [
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
        $this->requireLogin();

        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';

        // [title] => The Green Mile
        // [author_id] => default
        // [stock] => 3

        $book = new Book($_POST);

        $authors = Author::getAll();

        if ($book->save()) {

            // Redirect to avoid form resubmission
            Flash::addMessage('Book successfully added');

            $this->redirect('/books/index');
        } else {

            View::render('Books/new.php', [
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
        $this->requireLogin();

        $id = $this->route_params['id'];

        // echo '<pre>';
        // print_r($this->route_params);
        // echo '</pre>';
        // echo $id;
        // echo '<hr>';
        // echo 'kuku';

        $authors = Author::getAll();
        $book = Book::findByID($id);
        // $miau = $book->author_id;
        // $author = Author::getAuthor($book->author_id);

        // echo '<pre>';
        // print_r($book);
        // print_r($authors);
        // echo '</pre>';

        View::render('Books/edit.php', [
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
        $this->requireLogin();

        $id = $this->route_params['id'];

        $book = Book::getBook($id);

        echo '<pre>';
        print_r($book);
        echo '</pre>';

        // if ($book->updateBook($_POST)) {

        //     Flash::addMessage('Changes saved');

        //     $this->redirect("/books/index");
        // } else {
        //     // Redisplay the form passing in the user model as this will contain
        //     // any validation error messages to display back in the form
        //     View::render('Books/edit.php', [
        //         'book' => $book
        //     ]);
        // }
    }

    /**
     * Delete the book
     * 
     * @return void
     */
    public function deleteAction()
    {
        $this->requireLogin();

        $id = $this->route_params['id'];

        $book = Book::getBook($id);

        if ($book->deleteBook()) {

            Flash::addMessage('Book was successfully deleted');

            $this->redirect("/boooks/index");
        } else {
            // Redisplay the form passing in the user model as this will contain
            // any validation error messages to display back in the form
            View::render('Books/delete.php', [
                'book' => $book
            ]);
        }
    }
}
