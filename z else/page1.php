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

    <?php if (isset($_SESSION['user'])) :
        echo '<pre>';
        print_r($_SESSION);
        var_dump($_SESSION);
        print_r(get_defined_vars());
        echo '</pre>';

    ?>
        <p> Welcome back, <?= $_SESSION['user'] ?></p>

    <?php else :
        echo '<pre>';
        print_r($_SESSION);
        var_dump($_SESSION);
        print_r(get_defined_vars());
        echo '</pre>';

    ?>
        <p>Hello stranger</p>
    <?php endif; ?>

</body>

</html>