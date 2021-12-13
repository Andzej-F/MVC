<?php

namespace Core;

class Router2
{

    protected $routes = [];
    // protected $routes = [
    //     "/^admin\/(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/i" => ['namespace' => 'Admin']
    // ];

    protected $params = [];
    // $params = ["namespace" => "Admin", "controller" => "users", "action" => "index"];

    // $router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);
    public function add($route, $params = []): void
    {
        $route = preg_replace('/\//', '\\/', $route);
        // $route = "admin\/{controller}\/{action}";

        $route = preg_replace('/\{([a-z-]+)\}/', '(?P<\1>[a-z-]+)', $route);
        // $route = "admin\/(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)";

        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
        // $route = "admin\/(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)";

        $route = '/^' . $route . '$/i';
        // $route = "/^admin\/(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/i";

        $this->routes[$route] = $params;
        // $this->routes["/^admin\/(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/i"] =
        //                                                      ['namespace' => 'Admin'];
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    // $url = "admin/users/action";
    public function match($url): bool
    {
        // $this->routes=[
        //     "/^admin\/(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/i" =>
        //     ['namespace' => 'Admin']
        // ];

        // $route = "/^admin\/(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/i";
        // $params = ['namespace' => 'Admin'];
        foreach ($this->routes as $route => $params) {

            if (preg_match($route, $url, $matches)) {
                // preg_match("/^admin\/(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/i",
                //            "admin/users/action",
                //             $matches);

                // $matches = [
                //     0 => "admin/users/index",
                //     "controller" => "users",
                //     1 => "users",
                //     "action" => "index",
                //     2 => "index"
                // ];

                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                        // $params["controller"] = "users";
                        // $params["action"] = "index";
                    }
                }

                $this->params = $params;
                // $this->params = ["namespace" => "Admin", "controller" => "users", "action" => "index"];

                return true;
            }
        }

        return false;
    }

    public function getParams()
    {
        return $this->params;
    }

    // admin/controller/action
    public function dispatch($url): void
    {
        $url = $this->removeQueryStringVariables($url);

        if ($this->match($url)) {
            // $this->params = ["namespace" => "Admin", "controller" => "users", "action" => "index"];

            $controller = $this->params['controller'];
            // $controller = "users";

            $controller = $this->convertToStudlyCaps($controller);
            // $controller = "Users";

            $controller = $this->getNamespace() . $controller;
            // $namespace = "App\Controllers\Admin\Users";
            // $controller = $this->getNamespace()."Users";

            if (class_exists($controller)) {
                $controller_object = new $controller($this->params);
                // $controller_object = new App\Controllers\Admin\Users([
                //     "namespace" => "Admin",
                //     "controller" => "users",
                //     "action" => "index"
                // ]);

                $action = $this->params['action'];

                $action = $this->convertToCamelCase($action);

                if (preg_match('/action$/i', $action) == 0) {
                    $action = $action . "Action";
                    $controller_object->$action();
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

    protected function convertToStudlyCaps($string): string
    {
        $string = str_replace('-', ' ', $string);

        $string = ucwords($string);

        $string = str_replace(' ', '', $string);

        return $string;
    }

    protected function convertToCamelCase($string): string
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }

    // $url = "admin/controller/action";
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

        // $url = "admin/users/index";
        if ($url != '') {
            //explode(string $separator, string $string, int $limit = PHP_INT_MAX): array

            $parts = explode('&', $url, 2);

            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }

        return $url;
        // $url="admin/users/index";
    }

    /**
     * Get the namespace for the controller class. The namespace defined in the
     * route parameters is added if present
     * 
     * @return string The request URL
     */

    // $controller = $this->getNamespace()."Users";
    protected function getNamespace()
    {
        $namespace = "App\Controllers\\";

        // $params = ["namespace" => "Admin", "controller" => "users", "action" => "index"];
        if (array_key_exists('namespace', $this->params)) {
            // $namespace .= $this->params['namespace'] . '\\';
            $namespace = $namespace . $this->params['namespace'] . '\\';
            // $namespace = "App\Controllers\\" ."Admin" . '\\';
            $namespace = "App\Controllers\Admin\\";
        }

        return $namespace;
    }
}
