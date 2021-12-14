<?php include_once '../App/Views/header.php'; ?>

<h1>Welcome</h1>
<p>Hello <?= htmlspecialchars($name); ?></p>

<ul>
    <?php foreach ($colours as $colour) : ?>
        <li><?= htmlspecialchars($colour); ?></li>
    <?php endforeach; ?>
</ul>
</body>

</html>

<?php include_once '../App/Views/footer.php'; ?>