<?php include_once '../App/Views/header.php'; ?>

<h1>Welcome</h1>

<?php if (isset($_SESSION['user_id'])) : ?>
    User with ID <?= $_SESSION['user_id']; ?> is logged in.
    <a href="http://localhost/PHP/Other/MVC/public/login/destroy">Log out</a>
<?php else : ?>
    <a href="/signup/new">Sign up</a> or <a href="/login">log in</a>
<?php endif; ?>

</body>

</html>

<?php include_once '../App/Views/footer.php'; ?>