<?php

echo $_SERVER['DOCUMENT_ROOT'];
echo '<br>';
echo $_SERVER['SERVER_NAME'];
echo '<br>';
echo $_SERVER['REQUEST_URI'];
echo '<br>';
$path = $_SERVER['SERVER_NAME'] . '/' . $_SERVER['REQUEST_URI'];
echo $path;
