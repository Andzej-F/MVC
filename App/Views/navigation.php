    <nav>
        <ul>
            <li><a href="http://localhost/PHP/Other/MVC/public/">Home</a></li>
            <li><a href="http://localhost/PHP/Other/MVC/public/posts">Posts</a></li>
            <li><a href="http://localhost/PHP/Other/MVC/public/authors/index">Authors</a></li>
            <li><a href="">Books</a></li>
            <li><a href="http://localhost/PHP/Other/MVC/public/login">Login</a></li>
            <?php if ($current_user) : ?>
                <li><a href="http://localhost/PHP/Other/MVC/public/logout">Logout</a></li>
                <li><a href="http://localhost/PHP/Other/MVC/public/profile/show">Profile</a></li>
            <?php endif; ?>
            <li><a href="http://localhost/PHP/Other/MVC/public/signup/new">Sign Up</a></li>
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