<?php include_once '../App/Views/header.php'; ?>

<?php include_once '../App/Views/navigation.php'; ?>

<h1>Books</h1>
<h2>Search for a book or author</h2>
<table>
    <thead>
        <tr>Sort by:</tr>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Available</th>
            <th>Borrowed</th>
            <?php if ($current_user) : ?>
                <th>Edit</th>
                <th>Delete</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php if ($books) : ?>
            <?php foreach ($books as $book) : ?>
                <tr>
                    <td><?= htmlspecialchars($book->title); ?></td>
                    <td><?= htmlspecialchars($book->name) . ' ' . htmlspecialchars($book->surname) ?></td>
                    <td><?= htmlspecialchars($book->genre); ?></td>
                    <td><?= htmlspecialchars($book->available); ?></td>
                    <td><?= htmlspecialchars($book->borrowed); ?></td>
                    <?php if ($current_user) : ?>
                        <td>
                            <a href=<?= "http://localhost/PHP/lbm2/public/books/$book->book_id/edit"; ?>>EDIT</a>
                        </td>
                        <td>
                            <a href=<?= "http://localhost/PHP/lbm2/public/books/$book->book_id/delete"; ?>>DELETE</a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
<?php if ($current_user) : ?>
    <a href="http://localhost/PHP/lbm2/public/books/new">Add a new book</a>
<?php endif; ?>
</body>

</html>

<?php include_once '../App/Views/footer.php'; ?>