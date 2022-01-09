<?php require_once '../App/Views/header.php'; ?>

<h1>Welcome</h1>

<?php require_once '../App/Views/navigation.php'; ?>

<?php if ($current_user) : ?>
    Hello <?= htmlspecialchars($current_user->name); ?>
    <a href="http://localhost/PHP/lbm2/public/login/destroy">Log out</a>
<?php endif; ?>
</body>

</html>

<?php require_once '../App/Views/footer.php'; ?>