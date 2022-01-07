<?php include_once '../App/Views/header.php'; ?>

<h1>Log in</h1>

<?php include_once '../App/Views/navigation.php'; ?>

<form method="post" action="http://localhost/PHP/lbm2/public/login/create">

    <div>
        <label for="inputEmail">Email address</label>
        <input id="inputEmail" name="email" placeholder="email address" autofocus value=<?= isset($email) ? htmlspecialchars($email) : ''; ?>>
    </div>

    <div>
        <label for="inputPassword">Password</label>
        <input type="password" id="inputPassword" name="password" placeholder="Password">
    </div>

    <button type="submit">Log in</button>

</form>

<?php include_once '../App/Views/footer.php'; ?>