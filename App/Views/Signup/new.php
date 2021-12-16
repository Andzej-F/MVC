<?php include_once '../App/Views/header.php'; ?>

<h1>Sign up</h1>

<?php
if (!empty($user->errors)) { ?>
    <p>Errors: </p>
    <ul>
        <?php foreach ($user->errors as $error) { ?>
            <li><?= htmlspecialchars($error); ?></li>
        <?php } ?>
    </ul>
<?php } ?>

<form method="post" action="http://localhost/PHP/Other/MVC/public/signup/create">

    <div>
        <label for="inputName">Name</label>
        <input id="inputName" name="name" placeholder="Name" autofocus value=<?= isset($user->name) ? htmlspecialchars($user->name) : ''; ?>>
    </div>

    <div>
        <label for="inputEmail">Email address</label>
        <input id="inputEmail" name="email" placeholder="email address" autofocus value=<?= isset($user->email) ? htmlspecialchars($user->email) : ''; ?>>
    </div>

    <div>
        <label for="inputPassword">Password</label>
        <input type="password" id="inputPassword" name="password" placeholder="Password">
    </div>

    <div>
        <label for="inputPasswordConfirmation">Repeat password</label>
        <input type="password" id="inputPasswordConfirmation" name="password_confirmation" placeholder="Repeat password">
    </div>

    <button type="submit">Sign up</button>

</form>

<?php include_once '../App/Views/footer.php'; ?>