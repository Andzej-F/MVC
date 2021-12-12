<?php
/*
spl_autoload_register() allows you to register multiple functions 
(or static methods from your own Autoload class) that PHP will put 
into a stack/queue and call sequentially when a "new Class" is declared.

So for example:
*/
// spl_autoload_register(
//     function ($class) {
//         $root = dirname(__DIR__, 1); // get the parent directory
//         $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
//         if (is_readable($file)) {
//             require $file;
//         }
//     }
// );



spl_autoload_register('myAutoloader');

function myAutoloader($className)
{
    $root = dirname(__DIR__, 1); // get the parent directory
    $file = $root . '/' . str_replace('\\', '/', $className) . '.php';
    if (is_readable($file)) {
        require $file;
    }
}

//-------------------------------------

$myClass = new MyClass();
/*
In the example above, "MyClass" is the name of the class that you are 
trying to instantiate, PHP passes this name as a string to spl_autoload_register(),
which allows you to pick up the variable and use it to "include" the 
appropriate class/file. As a result you don't specifically need to include 
that class via an include/require statement...

Just simply call the class you want to instantiate like in the example 
above, and since you registered a function (via spl_autoload_register()) 
of your own that will figure out where all your class are located, PHP 
will use that function.

The benefit of using spl_autoload_register() is that unlike __autoload() 
you don't need to implement an autoload function in every file that you 
create. spl_autoload_register() also allows you to register multiple autoload
functions to speed up autoloading and make it even easier.

Example:

spl_autoload_register('MyAutoloader::ClassLoader');
spl_autoload_register('MyAutoloader::LibraryLoader');
spl_autoload_register('MyAutoloader::HelperLoader');
spl_autoload_register('MyAutoloader::DatabaseLoader');

class MyAutoloader
{
    public static function ClassLoader($className)
    {
         //your loading logic here
    }


    public static function LibraryLoader($className)
    {
         //your loading logic here
    }
With regards to spl_autoload, the manual states:

This function is intended to be used as a default implementation for 
__autoload(). If nothing else is specified and spl_autoload_register() 
is called without any parameters then this functions will be used for 
any later call to __autoload().

In more practical terms, if all your files are located in a single directory 
and your application uses not only .php files, but custom configuration files 
with .inc extensions for example, then one strategy you could use would be to 
add your directory containing all files to PHP's include path (via 
set_include_path()).
And since you require your configuration files as well, you would use 
spl_autoload_extensions() to list the extensions that you want PHP to look for.

Example:

set_include_path(get_include_path().PATH_SEPARATOR.'path/to/my/directory/');
spl_autoload_extensions('.php, .inc');
spl_autoload_register();
Since spl_autoload is the default implementation of the __autoload() magic 
method, PHP will call spl_autoload when you try and instantiate a new class.

Hope this helps...
*/