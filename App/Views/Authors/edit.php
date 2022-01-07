<?php include_once '../App/Views/header.php'; ?>

<h1>Edit new author</h1>

<?php include_once '../App/Views/navigation.php'; ?>

<?php if (!empty($author->errors)) : ?>
    <p>Errors</p>
    <ul>
        <?php foreach ($author->errors as $error) : ?>
            <li><?= htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
    <?php endif; ?>

    </ul>
    <form method="post" action="<?= "http://localhost/PHP/lbm2/public/authors/$author->author_id/update"; ?>">

        <div>
            <label for="authorName">Name</label>
            <input id="authorName" name="name" placeholder="Name" value="<?= (isset($author->name) ? htmlspecialchars($author->name) : ''); ?>">
        </div>

        <div>
            <label for="authorSurname">Surname</label>
            <input id="authorSurname" name="surname" placeholder="Surname" value="<?= (isset($author->surname) ? htmlspecialchars($author->surname) : ''); ?>">
        </div>

        <button type="submit">Edit</button>

    </form>

    <?php include_once '../App/Views/footer.php'; ?>