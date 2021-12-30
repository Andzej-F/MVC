<?php include_once '../App/Views/header.php'; ?>

<?php include_once '../App/Views/navigation.php'; ?>

<h1>Books</h1>

<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Stock</th>
            <?php if ($current_user) : ?>
                <th>Update</th>
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
                    <td><?= htmlspecialchars($book->stock); ?></td>
                    <?php if ($current_user) : ?>
                        <td>
                            <a href=<?= "http://localhost/PHP/Other/MVC/public/books/$book->book_id/edit"; ?>>EDIT</a>
                        </td>
                        <td>
                            <a href=<?= "http://localhost/PHP/Other/MVC/public/books/$book->book_id/delete"; ?>>DELETE</a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
<?php if ($current_user) : ?>
    <a href="http://localhost/PHP/Other/MVC/public/books/new">Add a new book</a>
<?php endif; ?>
</body>

</html>

<?php include_once '../App/Views/footer.php'; ?>