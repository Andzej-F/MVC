<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MVC</title>
    <link rel="stylesheet" href="http://localhost/PHP/Other/MVC/public/css/style.css" type="text/css">

</head>

<body>
    <a href="http://localhost/PHP/Other/MVC/public/">Home</a>
    <a href="http://localhost/PHP/Other/MVC/public/posts">Posts</a>
    <a href="">Authors</a>
    <a href="">Books</a>
    <a href="http://localhost/PHP/Other/MVC/public/login">Login</a>
    <a href="http://localhost/PHP/Other/MVC/public/signup/new">Sign Up</a>
    <a href="">About</a>

    <?php
    if (isset($flash_messages)) :
        foreach ($flash_messages as $message) : ?>
            <div class="alert alert-<?= $message['type'] ?>">
                <?= htmlspecialchars($message['body']); ?>
            </div>
    <?php endforeach;
    endif; ?>