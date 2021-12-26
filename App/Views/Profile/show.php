<?php include_once '../App/Views/header.php'; ?>

<h1>Profile</h1>

<dl>
    <dt>Name</dt>
    <dd><?= htmlspecialchars($user->name); ?></dd>
    <dt>email</dt>
    <dd><?= htmlspecialchars($user->email); ?></dd>
</dl>

<a href="http://localhost/PHP/Other/MVC/public/profile/edit">Edit</a>

<?php include_once '../App/Views/footer.php'; ?>