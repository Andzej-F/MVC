<?php require_once '../App/Views/header.php'; ?>

<h1>Profile</h1>

<?php require_once '../App/Views/navigation.php'; ?>

<?php
if (!empty($user->errors)) { ?>
    <p>Errors: </p>
    <ul>
        <?php foreach ($user->errors as $error) { ?>
            <li><?= htmlspecialchars($error); ?></li>
        <?php } ?>
    </ul>
<?php } ?>

<form method="post" action="http://localhost/PHP/lbm2/public/profile/update">

    <div>
        <label for="inputName">Name</label>
        <input id="inputName" name="name" placeholder="Name" value=<?= isset($user->name) ? htmlspecialchars($user->name) : ''; ?>>
    </div>

    <div>
        <label for="inputEmail">Email address</label>
        <input id="inputEmail" name="email" placeholder="email address" value=<?= isset($user->email) ? htmlspecialchars($user->email) : ''; ?>>
    </div>

    <div>
        <label for="inputPassword">Password</label>
        <input type="password" id="inputPassword" name="password" placeholder="Password" value=<?= isset($user->password) ? htmlspecialchars($user->password) : ''; ?>>
    </div>

    <div>
        <label for="inputPasswordConfirmation">Repeat password</label>
        <input type="password" id="inputPasswordConfirmation" name="password_confirmation" placeholder="Repeat password" value=<?= isset($user->password_confirmation) ? htmlspecialchars($user->password_confirmation) : ''; ?>>
    </div>

    <button type="submit">Save</button>
    <a href="http://localhost/PHP/lbm2/public/profile/show">Cancel</a>

</form>

<?php require_once '../App/Views/footer.php'; ?>