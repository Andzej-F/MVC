    <nav>
        <ul>
            <li><a href="http://localhost/PHP/lbm2/public/">Home</a></li>
            <li><a href="http://localhost/PHP/lbm2/public/posts">Posts</a></li>
            <li><a href="http://localhost/PHP/lbm2/public/authors/index">Authors</a></li>
            <li><a href="http://localhost/PHP/lbm2/public/books/index">Books</a></li>
            <?php if (!$current_user) : ?>
                <li><a href="http://localhost/PHP/lbm2/public/login">Login</a></li>
            <?php endif; ?>
            <?php if ($current_user) : ?>
                <li><a href="http://localhost/PHP/lbm2/public/logout">Logout</a></li>
                <li><a href="http://localhost/PHP/lbm2/public/profile/show">Profile</a></li>
            <?php endif; ?>
            <li><a href="http://localhost/PHP/lbm2/public/signup/new">Sign Up</a></li>
            <li><a href="">About</a></li>
        </ul>
    </nav>

    <?php
    if (isset($flash_messages)) :
        foreach ($flash_messages as $message) : ?>
            <div class="alert alert-<?= $message['type'] ?>">
                <?= htmlspecialchars($message['body']); ?>
            </div>
    <?php endforeach;
    endif; ?>