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
     * @param array $args Associative array of data to display in the view (optional)
     * 
     * @return void
     */
    //         View::render('Home/index.php', [
    // 'name' => 'Dave',
    // 'colours' => ['red', 'green', 'blue']
    // ]);;

    // $view ="Home/index.php";
    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);
        // $name = 'Dave';
        // $colours = [
        //     0 => "red",
        //     1 => "green",
        //     2 => "blue"
        // ];

        $file = "../App/Views/$view"; // Relative to Core directory
        // $file = "../App/Views/Home/index.php";

        if (is_readable($file)) {
            require $file;
        } else {
            echo "$file not found";
        }
    }

    // /**
    //  * Render a view template using Twig
    //  * 
    //  * @param string $template The template file
    //  * @param array $args Associative array of datta to display in the view (optional)
    //  * 
    //  * @return void
    //  */
    // public static function renderTemplate($template, $args = [])
    // {
    //     static $twig = null;

    //     if ($twig === null) {
    //         $loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/App/Views');
    //         // $loader = new \Twig\Loader\FilesystemLoader(C:\xampp\htdocs\PHP\Other\MVC/App/Views');

    //         $twig = new \Twig\Environment($loader);
    //     }

    //     echo $twig->render($template, $args);
    // }
}
