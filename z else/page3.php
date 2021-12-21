<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Session Demo</title>
</head>

<body>

    <h1>PHP Session Demo</h1>

    <p>Current session ID: <?= session_id(); ?></p>

    <a href="http://localhost/PHP/Other/MVC/z%20else/destroy.php">Destroy</a>

</body>

</html>