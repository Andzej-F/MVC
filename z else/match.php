<?php































// $matches = [0 => ''];

// foreach ($matches as $key => $match) {
//     echo '<pre>';
//     print_r($matches);
//     echo '</pre>';
//     echo __LINE__ . '<br>';
//     if (is_string($key)) {
//         echo __LINE__ . '<br>';
//         $params[$key] = $match;
//     }
// }

// explode(string $separator, string $string, int $limit = PHP_INT_MAX): array
$result = explode("&", "posts", 2);

echo '<pre>';
print_r($result);
echo '</pre>';

echo str_replace('-', ' ', "Posts");
echo '<hr>';

echo ucwords("johan johan");
