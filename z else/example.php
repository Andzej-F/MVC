<?php
$var = NULL;
if (!$var) {
    echo 'Not null';
}

class Example2
{
}
echo '<hr>';
$example2 = new Example2();

if ($example2) {
    echo 'There is an object';
}
