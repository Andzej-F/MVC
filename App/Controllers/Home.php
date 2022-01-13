<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Book;
use \App\Auth;

/**
 * Home controller
 * 
 * PHP version 8.1.1
 */
class Home extends \Core\Controller
{
    /**
     * Show the index page
     * 
     * @return void
     */
    public function indexAction()
    {
        $new_books = Book::getNewBooks();

        View::renderTemplate('Home/index.html', [
            'new_books' => $new_books
        ]);
    }
}
