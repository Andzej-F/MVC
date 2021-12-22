<?php

echo $_SERVER['REQUEST_URI'] . '<br>'; // /PHP/Other/MVC/z%20else/example.php
echo $_SERVER['SERVER_NAME'] . '<br>'; // 
echo $_SERVER['HTTP_HOST'] . '<br>'; // localhost
echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
