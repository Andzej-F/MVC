<?php

namespace App\Controllers;

use \Core\View;

/**
 * Profile controller
 * 
 * PHP version 8.0.7
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

        View::render('Profile/show.php');
    }
}
