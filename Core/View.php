<?php

namespace Core;

/**
 * View 
 * 
 * PHP version 8.0.7
 */
class View
{
    /**
     * Render a view file
     * 
     * @param string $view The view file
     * 
     * @return void
     */
    //         View::render('Home/index.php');
    // $view ="Home/index.php";
    public static function render($view)
    {
        $file = "../App/Views/$view"; // Relative to Core directory
        // $file = "../App/Views/Home/index.php";

        if (is_readable($file)) {
            require $file;
        } else {
            echo "$file not found";
        }
    }
}
