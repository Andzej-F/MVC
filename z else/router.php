<?php

namespace Core;

class Router2
{

    protected $routes = [];
    //$routes = ['^posts$/i' => ['controller' => 'Posts', 'action' => 'index']];

    protected $params = [];
    // $params = ['controller' => 'Posts', 'action' => 'index'];

    // $router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
    public function add($route, $params = []): void
    {
        $route = preg_replace('/\//', '\\/', $route);
        // $route = 'posts';

        $route = preg_replace('/\{([a-z-]+)\}/', '(?P<\1>[a-z-]+)', $route);
        // $route = 'posts';

        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
        // $route = 'posts';

        $route = '/^' . $route . '$/i';
        // $route = '/^posts$/i';

        $this->routes[$route] = $params;
        // $this->routes['^posts$/i'] = ['controller' => 'Posts', 'action' => 'index'];
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    // $url = "posts";
    public function match($url): bool
    {
        // $this->routes = [
        //     '^posts$/i' => ['controller' => 'Posts', 'action' => 'index']
        // ];
        foreach ($this->routes as $route => $params) {
            // $route= '^posts$/i';
            // $params = ['controller' => 'Posts', 'action' => 'index'];

            if (preg_match($route, $url, $matches)) {
                // preg_match('^posts$/i', 'posts', $matches);
                // $matches=[0 => "posts"];

                foreach ($matches as $key => $match) {
                    // foreach([0 => "posts"] as 0 => "posts")
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }

                $this->params = $params;
                // $this->params = ['controller' => 'Posts', 'action' => 'index'];

                return true;
            }
        }

        return false;
    }

    public function getParams()
    {
        return $this->params;
    }

    // $url = "posts";
    public function dispatch($url): void
    {
        $url = $this->removeQueryStringVariables($url);

        if ($this->match($url)) {
            $controller = $this->params['controller'];
            //$controller = "Posts";

            $controller = $this->convertToStudlyCaps($controller);
            //$controller = "Posts";

            $controller = "App\Controllers\\$controller";
            // $controller = "App\Controllers\Posts";

            if (class_exists($controller)) {
                $controller_object = new $controller($this->params);
                // $controller_object = new App\Controllers\Posts(
                //     ['controller' => 'Posts', 'action' => 'index']
                // );

                $action = $this->params['action'];
                // $action = 'index';

                $action = $this->convertToCamelCase($action);
                // $action = 'index';

                if (preg_match('/action$/i', $action) == 0) {
                    $controller_object->$action();
                    // App\Controllers\Posts->index();

                } else {
                    throw new \Exception("Method $action in controller $controller cannot be called directly - remove the Action suffix to call this method");
                }
            } else {
                echo "Controller class $controller not found";
            }
        } else {
            echo "No route matched";
        }
    }

    // $string = "Posts";
    protected function convertToStudlyCaps($string): string
    {
        $string = str_replace('-', ' ', $string);
        //$string = "Posts";

        $string = ucwords($string);
        //$string = "Posts";

        $string = str_replace(' ', '', $string);

        return $string;
        //$string = "Posts";
    }

    // $string = "index";
    protected function convertToCamelCase($string): string
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }

    // $url = "posts";
    protected function removeQueryStringVariables($url): string
    {
        /*
        URL                           $_SERVER['QUERY_STRING']
        ------------------------------------------------------
        localhost                     ''                      
        localhost/?                   ''                      
        localhost/?page=1             page=1                  
        localhost/posts?page=1        posts&page=1            
        localhost/posts/index         posts/index             
        localhost/posts/index?page=1  posts/index&page=1     
        localhost/&page=1  posts/index&page=1     
        */

        // $url = "posts";
        if ($url != '') {
            //explode(string $separator, string $string, int $limit = PHP_INT_MAX): array

            $parts = explode('&', $url, 2);
            // $parts = [0 => "posts"];

            if (strpos($parts[0], '=') === false) {
                // $parts[0] = "posts";
                $url = $parts[0];
                // $url = "posts";
            } else {
                $url = '';
            }
        }

        return $url;
        // $url = "posts";
    }
}
