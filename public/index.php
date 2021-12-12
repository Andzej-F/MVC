<?php

/**
 * Front controller
 *
 * PHP version 8.0.7
 */

// Require the controller class
// require '../App/Controllers/Posts.php';
// require '../App/Controllers/Authors.php';
// require '../App/Controllers/Books.php';
// require '../App/Controllers/Librarians.php';
// require '../App/Controllers/Readers.php';

/**
 * Autoloader
 */
// spl_autoload_register(?callable $callback = null,
//                      bool $throw = true,
// bool $prepend = false): bool
// spl=standard PHP library
// spl_autoload_register(function ($class) {
//     $root = dirname(__DIR__, 1); // get the parent directory
//     $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
//     if (is_readable($file)) {
//         require $file;
//     }

//     // echo '<pre>';
//     // print_r(debug_backtrace());
//     // echo '</pre>';
// }, true, false);


spl_autoload_register('myAutoloader', true, false);

// "myAutoloader" will run when autoloader is needed
// $controller = "App\Controllers\Posts";
function myAutoloader($className)
{
    $root = dirname(__DIR__, 1); // get the parent directory
    // echo $root . '<br>';
    // $root = C:\xampp\htdocs\PHP\Other\MVC
    $file = $root . '/' . str_replace('\\', '/', $className) . '.php';
    // $file = C:\xampp\htdocs\PHP\Other\MVC/App/Controllers/Posts.php
    // echo $file . '<br>';
    if (is_readable($file)) {
        require $file;
    }
}
/**
 * Routing
 */
// require '../Core/Router.php';

$router = new Core\Router();

// Add the routes
// $router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'indexAction']);
// $router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);
// $router->add('users', ['controller' => 'Users', 'action' => 'index']);

// $router->add('{controller}/{action}');
// $router->add('{controller}/{id:\d+}/{action}');
// $router->add('admin/{action}/{controller}');

/*
// Display the routing table
echo '<pre>';
// var_dump($router->getRoutes());
// print_r($router->getRoutes());
echo htmlspecialchars(print_r($router->getRoutes(), true));
echo '</pre>';

// Match the requested route
$url = $_SERVER['QUERY_STRING'];
// echo $url;

echo "<hr>";
if ($router->match($url)) {
    echo '<pre>';
    var_dump($router->getParams());
    echo '</pre>';
} else {
    echo "No route found for URL '$url'";
}
*/

$router->dispatch($_SERVER['QUERY_STRING']);
// echo $_SERVER['QUERY_STRING'];
