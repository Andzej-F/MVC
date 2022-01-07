<?php
// $sql = 'UPDATE `users`
//         SET `name` = :name,
//         `email` = :email,';

// // if (isset($this->password)) {
// $sql .= "`password_hash` = :password_hash";
// // }

// $sql .= "\nWHERE `id` = :id";

// echo $sql;
// echo '<hr>';

// $sql = 'UPDATE users
//                     SET name = :name,
//                         email = :email';

// // Add password if it's set
// // if (isset($this->password)) {
// $sql .= ', password_hash = :password_hash';
// // }

// $sql .= "\nWHERE id = :id";

// echo $sql;

class Product
{
        public function __call($method, $args)
        {
                // run code before
                call_user_func_array([$this, $method], $args);
                // run code after
        }

        public function save()
        {
                echo "Hello from the public \"save\" method<br>";
        }

        protected function load()
        {
                echo "Hello from the protected \"load\" method<br>";
        }

        private function publish()
        {
                echo "Hello from the private \"publish\" method <br>
                      Argument 1 : <br>
                      Argument 2 : <br>";
        }
}

$product = new Product();

$product->save();
// $product->load();
// $product->publish(123, "a");
$product->load();
$product->publish();

// $method = "publish";
// $args = [123, "a"];

class Posts2
{
        public function __call($name, $args)
        {
                // run code before
                call_user_func_array([$this, "$nameAction"], $args);
                // run code after
        }

        public function indexAction()
        {
        }
}

$controller = new Posts();
// Call index() method on a controller object
$controller->index();

// Method "index()" doesn't exist so "__call" magic method is executed

// Run code before

// call indexAction()

// Run code after