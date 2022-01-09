<?php require_once '../App/Views/header.php'; ?>
<?php require_once '../App/Views/navigation.php'; ?>

<h1>Posts</h1>

<ul>
    <?php foreach ($posts as $post) : ?>
        <h2><?= htmlspecialchars($post['title']); ?></h2>
        <p><?= htmlspecialchars($post['content']); ?></p>
    <?php endforeach ?>
</ul>
</body>

</html>

<?php require_once '../App/Views/footer.php'; ?>