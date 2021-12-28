<?php include_once '../App/Views/header.php'; ?>

<h1>Authors</h1>

<?php include_once '../App/Views/navigation.php'; ?>

<?php
if (!empty($user->errors)) { ?>
    <p>Errors: </p>
    <ul>
        <?php foreach ($user->errors as $error) { ?>
            <li><?= htmlspecialchars($error); ?></li>
        <?php } ?>
    </ul>
<?php } ?>

<form method="post" action="http://localhost/PHP/Other/MVC/public/author/create">

    <div>
        <label for="inputName">Name</label>
        <input id="inputName" name="name" placeholder="Name" autofocus value=<?= isset($author->name) ? htmlspecialchars($author->name) : ''; ?>>
    </div>

    <div>
        <label for="inputSurname">Surname</label>
        <input id="inputSurname" name="surname" placeholder="surname" autofocus value=<?= isset($suthor->surname) ? htmlspecialchars($suthor->surname) : ''; ?>>
    </div>

    <button type="submit">Add</button>
    <a href="http://localhost/PHP/Other/MVC/public/author/index">Cancel</a>

</form>

<?php include_once '../App/Views/footer.php'; ?>