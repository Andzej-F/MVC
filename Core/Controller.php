<?php

namespace Core;

/**
 * Base controller
 *
 * PHP version 8.0.7
 */
abstract class Controller
{
    /**
     * Parameters from the matched route
     * @var array
     */
    protected $route_params = [];

    /**
     * Class constructor
     * 
     * @param array $route_params Parameters from the route
     * 
     * @return void
     */
    public function __construct($route_params)
    {
        $this->route_params = $route_params;
    }

    // /**
    //  * 
    //  * 
    //  * @return void
    //  */
    // public function __call($name, $args)
    // {
    //     $method = $name . 'Action';

    //     if (method_exists($this, $method)) {
    //         if ($this->before() !== false) {
    //             call_user_func_array([$this, $method], $args);
    //             $this->after();
    //         }
    //     } else {
    //         echo "Method $method not found in controller " . get_class($this);
    //     }
    // }

    /**
     * Before filter
     * 
     * @return void
     */
    abstract protected function before();

    /**
     * After filter
     * 
     * @return void
     */

    abstract protected function after();

    /**
     * Redirect to a different page
     * 
     * @param string $url The relative URL
     * 
     * @return void
     */
    public function redirect($url)
    {
        header('Location: http://localhost/PHP/Other/MVC/public' . $url, true, 303);
        exit;
    }
}
