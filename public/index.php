<?php

/**
 * Front controller
 *
 * PHP version 8.0.7
 */

/**
 * Autoloader
 */
spl_autoload_register('myAutoloader', true, false);

// "myAutoloader" will run when autoloader is needed
function myAutoloader($className)
{
    $root = dirname(__DIR__, 1); // get the parent directory
    $file = $root . '/' . str_replace('\\', '/', $className) . '.php';
    if (is_readable($file)) {
        require $file;
    }
}

/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);
// $router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);
// $router->add('users', ['controller' => 'Users', 'action' => 'index']);

$router->add('{controller}/{action}');
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
