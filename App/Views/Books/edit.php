<?php require_once '../App/Views/header.php'; ?>

<h1>Edit the book</h1>

<?php require_once '../App/Views/navigation.php'; ?>

<?php if (!empty($book->errors)) : ?>
    <p>Errors</p>
    <ul>
        <?php foreach ($book->errors as $error) : ?>
            <li><?= htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php
    // echo '<pre>';
    // print_r($book);
    // // print_r($authors);
    // echo '</pre>';
    ?>
    </ul>
    <form method="post" action=<?= "http://localhost/PHP/lbm2/public/books/$book->book_id/update"; ?>>

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
            <label for="bookGenre">Genre</label>
            <input id="bookGenre" name="genre" placeholder="Genre" value="<?= (isset($book->genre) ? htmlspecialchars($book->genre) : ''); ?>">
        </div>

        <div>
            <label for="bookAvailable">Available</label>
            <input id="bookAvailable" name="available" placeholder="Available" value="<?= (isset($book->available) ? htmlspecialchars($book->available) : ''); ?>">
        </div>

        <div>
            <label for="bookBorrowed">Borrowed</label>
            <input id="bookBorrowed" name="borrowed" placeholder="Borrowed" value="<?= (isset($book->borrowed) ? htmlspecialchars($book->borrowed) : ''); ?>">
        </div>

        <button type="submit">Edit</button>

    </form>

    <?php require_once '../App/Views/footer.php'; ?>