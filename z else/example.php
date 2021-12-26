<?php
$sql = 'UPDATE `users`
                    SET `name` = :name,
                        `email` = :email,';

// if (isset($this->password)) {
$sql .= "`password_hash` = :password_hash";
// }

$sql .= "\nWHERE `id` = :id";

echo $sql;
echo '<hr>';

$sql = 'UPDATE users
                    SET name = :name,
                        email = :email';

// Add password if it's set
// if (isset($this->password)) {
$sql .= ', password_hash = :password_hash';
// }

$sql .= "\nWHERE id = :id";

echo $sql;
