<?php

namespace Core;

class Router2
{

    protected $routes = [];
    // protected $routes = [
    //     '/^(?P<controller>[a-z-]+)\/(?P<id>\d+)\/(?P<action>[a-z-]+)$/i' => []
    // ];

    protected $params = [];
    // $params = [
    //     "controller" => "librarians",
    //     "id" => "25",
    //     "action" => "login",
    // ];

    // $router->add('{controller}/{id:\d+}/{action}');
    public function add($route, $params = []): void
    {
        $route = preg_replace('/\//', '\\/', $route);
        // $route = '{controller}\/{id:\d+}\/{action}';

        $route = preg_replace('/\{([a-z-]+)\}/', '(?P<\1>[a-z-]+)', $route);
        // $route = '(?P<controller>[a-z-]+)\/{id:\d+}\/(?P<action>[a-z-]+)';

        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
        // $route = '(?P<controller>[a-z-]+)\/(?P<id>\d+)\/(?P<action>[a-z-]+)';

        $route = '/^' . $route . '$/i';
        // $route = '/^(?P<controller>[a-z-]+)\/(?P<id>\d+)\/(?P<action>[a-z-]+)$/i';

        $this->routes[$route] = $params;
        // $this->routes['/^(?P<controller>[a-z-]+)\/(?P<id>\d+)\/(?P<action>[a-z-]+)$/i'] = [];
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    // $url="librarians/25/login";
    public function match($url): bool
    {

        foreach ($this->routes as $route => $params) {
            // protected $routes = [
            //     '/^(?P<controller>[a-z-]+)\/(?P<id>\d+)\/(?P<action>[a-z-]+)$/i' => []
            // ];

            // $route = '/^(?P<controller>[a-z-]+)\/(?P<id>\d+)\/(?P<action>[a-z-]+)$/i';
            // $params =[];

            if (preg_match($route, $url, $matches)) {
                // preg_match(
                //     '/^(?P<controller>[a-z-]+)\/(?P<id>\d+)\/(?P<action>[a-z-]+)$/i',
                //     'librarians/25/login',
                //     $matches
                // );

                // $matches = [
                //     0 => 'librarians/25/login',
                //     'controller' => 'librarians',
                //     1 => 'librarians',
                //     'id' => 25,
                //     2 => 25,
                //     'action' => 'login',
                //     3 => 'login'
                // ];
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                        // $params["controller"] = "librarians";
                        // $params["id"] = "25";
                        // $params["action"] = "login";
                    }
                }

                $this->params = $params;
                // $this->params = [
                //     "controller" => "librarians",
                //     "id" => "25",
                //     "action" => "login",
                // ];

                return true;
            }
        }

        return false;
    }

    public function getParams()
    {
        return $this->params;
    }

    // $url="librarians/25/login&getinfo=true";
    public function dispatch($url): void
    {
        $url = $this->removeQueryStringVariables($url);
        // $url="librarians/25/login";

        if ($this->match($url)) {

            $controller = $this->params['controller'];
            // $controller = 'librarians'; 

            $controller = $this->convertToStudlyCaps($controller);
            // $controller = 'Librarians'; 

            $controller = $this->getNamespace() . $controller;
            // $namespace = "App\Controllers\\";
            // $controller = "App\Controllers\Librarians;

            if (class_exists($controller)) {
                $controller_object = new $controller($this->params);
                // $controller_object = new App\Controllers\Librarians($params = [
                //     "controller" => "librarians",
                //     "id" => "25",
                //     "action" => "login",
                // ]);

                $action = $this->params['action'];
                // $action = 'login';

                $action = $this->convertToCamelCase($action);
                // $action = 'login';

                if (preg_match('/action$/i', $action) == 0) {
                    $action = $action . "Action";
                    // $action = 'loginAction';

                    $controller_object->$action();
                    // $controller_object->$loginAction();
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

        // $url="librarians/25/login&getinfo=true";
        if ($url != '') {
            //explode(string $separator, string $string, int $limit = PHP_INT_MAX): array

            $parts = explode('&', $url, 2);
            // $parts = [
            // 0 => "librarians/25/login",
            // 1 => "getinfo=true"
            // ];

            if (strpos($parts[0], '=') === false) {
                // $parts[0] = "librarians/25/login";

                $url = $parts[0];
                //$url="librarians/25/login";
            } else {
                $url = '';
            }
        }

        return $url;
        // $url="librarians/25/login";
    }

    protected function getNamespace()
    {
        $namespace = "App\Controllers\\";
        // $params = [
        //     "controller" => "librarians",
        //     "id" => "25",
        //     "action" => "login",
        // ];

        if (array_key_exists('namespace', $this->params)) {
            $namespace = $namespace . $this->params['namespace'] . '\\';

            $namespace = "App\Controllers\Admin\\";
        }

        return $namespace;
    }
}
