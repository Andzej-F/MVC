<?php

$var_array = [
    "color" => "blue",
    "size" => "medium",
    "shapes" => ["sphere", "circle"]
];

extract($var_array);

echo $color . '<br>';
echo $size . '<br>';
print_r($shapes);
