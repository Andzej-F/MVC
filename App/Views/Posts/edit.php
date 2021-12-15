<?php include_once '../App/Views/header.php'; ?>

<h1>Posts Edit</h1>

<ul>
    <?php foreach ($posts as $post) : ?>
        <h2><?= htmlspecialchars($post['title']); ?></h2>
        <p><?= htmlspecialchars($post['content']); ?></p>
    <?php endforeach ?>
</ul>
</body>

</html>

<?php include_once '../App/Views/footer.php'; ?>