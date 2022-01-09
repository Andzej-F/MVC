<?php

namespace App\Controllers;

use \App\Models\User;

/**
 * Account controller
 * 
 * PHP version 8.1.1 
 *
 */
class Account extends \Core\Controller
{
    /**
     * Validate if email is available (AJAX) for a new signup.
     * 
     * @return void
     */
    public function validateEmailAction()
    {
        // Validation plugin sends an email address using the GET method
        $is_valid = !User::emailExists($_GET['email']);

        header('Content-Type: application/json');
        echo json_encode($is_valid);
    }
}

// /account/validate-email?email=steve@suns.com
// /account/validate-email?email=demo@daveh.io