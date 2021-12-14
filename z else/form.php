<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Output escaping</title>
</head>

<body>
    <h1>Output escaping</h1>
</body>

</html>

<?php
// Display the results of submitting the form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Hello, " . htmlspecialchars($_POST['name']);
}
?>

<form method="post">
    <div>
        <label for="name">Your name</label>
        <input id="name" name="name" autofocus>
    </div>

    <div>
        <button type="submit">Submit</button>
    </div>
</form>