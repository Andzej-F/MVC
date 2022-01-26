<?php

$vars = ['0', 0, '0015', 012, '123', 'not int', '01', 34, -145, 1.5, NULL];

foreach ($vars as $var) {
    var_dump($var);
    echo ' ->  ';
    $result = filter_var($var, FILTER_VALIDATE_INT);
    var_dump($result);
    echo '<br>';
}

/* '0' is a valid integer string. */
$var = '0';

/* filter_var() returns 0, but this check considers 0 as false! */
if (filter_var($var, FILTER_VALIDATE_INT) === false) {
    echo $var . ' is NOT a valid int!';
} else {
    echo $var . ' is a valid int!';
}
