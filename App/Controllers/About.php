<?php

namespace App\Controllers;

use \Core\View;
use \App\Flash;

/**
 * Books controller
 * 
 * PHP version 8.1.1
 */
class About extends \Core\Controller
{
    /**
     * Show the index page
     * 
     * @return void
     */
    public function indexAction()
    {
        View::renderTemplate('About/index.html');
    }
}
