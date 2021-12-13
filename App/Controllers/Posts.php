<?php

namespace App\Controllers;

/**
 * Posts controller
 * 
 * PHP version 8.0.7
 */
class Posts extends \Core\Controller
{
    /**
     * Before filter
     * 
     * @return void
     */
    protected function before()
    {
        echo "(before)";
        // return true;
    }

    /**
     * After filter
     * 
     * @return void
     */
    protected function after()
    {
        echo "(after)";
        // return true;
    }

    /**
     * Show the index page
     * 
     * @return mixed
     */
    public function indexAction()
    {
        $this->before();

        echo "Hello from the " . __FUNCTION__ . " action in the " . __CLASS__ . " controller!";
        echo '<p>Query string parameters: <pre>' .
            htmlspecialchars(print_r($_GET, true)) . '</pre></p>';
        echo '<p>Route parameters: <pre>' .
            htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';

        $this->after();
    }

    /**
     * Show the add new page
     * 
     * @return void
     */
    public function addNewAction()
    {
        if ($this->before() == false) {
            return;
        }

        echo "Hello from the " . __FUNCTION__ . " action in the " . __CLASS__ . " controller!";
        echo '<p>Route parameters: <pre>' .
            htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';

        $this->after();
    }

    public function editAction()
    {
        if ($this->before() == false) {
            return;
        }

        echo "Hello from the " . __FUNCTION__ . " action in the " . __CLASS__ . " controller!";
        echo '<p>Route parameters: <pre>' .
            htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';

        $this->after();
    }
}
