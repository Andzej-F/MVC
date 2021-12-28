<?php include_once '../App/Views/header.php'; ?>

<h1>Profile</h1>

<?php include_once '../App/Views/navigation.php'; ?>

<dl>
    <dt>Name</dt>
    <dd><?= htmlspecialchars($user->name); ?></dd>
    <dt>email</dt>
    <dd><?= htmlspecialchars($user->email); ?></dd>
</dl>

<a href="http://localhost/PHP/Other/MVC/public/profile/edit">Edit</a>

<?php include_once '../App/Views/footer.php'; ?>