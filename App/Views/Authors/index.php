<?php include_once '../App/Views/header.php'; ?>

<?php include_once '../App/Views/navigation.php'; ?>

<h1>Authors</h1>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Surname</th>
            <?php if ($current_user) : ?>
                <th>Edit</th>
                <th>Delete</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php if ($authors) : ?>
            <?php foreach ($authors as $author) : ?>
                <tr>
                    <td><?= htmlspecialchars($author->name); ?></td>
                    <td><?= htmlspecialchars($author->surname); ?></td>
                    <?php if ($current_user) : ?>
                        <td>
                            <a href=<?= "http://localhost/PHP/lbm2/public/authors/$author->author_id/edit"; ?>>EDIT</a>
                        </td>
                        <td>
                            <a href=<?= "http://localhost/PHP/lbm2/public/authors/$author->author_id/delete"; ?>>DELETE</a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
<?php if ($current_user) : ?>
    <a href="http://localhost/PHP/lbm2/public/authors/new">Add a new author</a>
<?php endif; ?>
</body>

</html>

<?php include_once '../App/Views/footer.php'; ?>