<?php include_once '../App/Views/header.php'; ?>

<h1>Add a new book</h1>

<?php include_once '../App/Views/navigation.php'; ?>

<?php if (!empty($book->errors)) : ?>
    <p>Errors</p>
    <ul>
        <?php foreach ($book->errors as $error) : ?>
            <li><?= htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
    <?php endif; ?>

    </ul>
    <form method="post" action="http://localhost/PHP/Other/MVC/public/books/create">

        <div>
            <label for="bookTitle">Title</label>
            <input id="bookTitle" name="title" placeholder="Title" value="<?= (isset($book->title) ? htmlspecialchars($book->title) : ''); ?>">
        </div>

        <div>
            <label for="bookAuthor">Author</label>
            <select name="author_id" id="author_id">
                <option value="default">Select the author</option>
                <?php if ($authors) : ?>
                    <?php foreach ($authors as $author) : ?>
                        <option value="<?= htmlspecialchars($author->author_id); ?>">
                            <?= htmlspecialchars($author->name) . ' ' . htmlspecialchars($author->surname); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <div>
            <label for="bookStock">Stock</label>
            <input id="bookStock" name="stock" placeholder="Stock" value="<?= (isset($book->stock) ? htmlspecialchars($book->stock) : ''); ?>">
        </div>

        <button type="submit">Add</button>

    </form>

    <?php include_once '../App/Views/footer.php'; ?>